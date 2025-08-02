<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Products;
use App\Models\ProductTranslation;
use Illuminate\Support\Facades\Http;

class FillMissingTranslations extends Command
{
    protected $signature = 'translations:fill {--test : Test mode without saving} {--all : Process all products instead of test batch}';
    protected $description = 'Fill missing product translations using DeepL API for ES, EN, DE, FR';

    private $supportedLocales = ['ca', 'es', 'en', 'fr', 'de'];
    private $deeplLocales = ['es', 'en', 'fr', 'de']; // Català es farà manualment

    public function handle()
    {
        if (env('DEEPL_KEY') === 'your_deepl_api_key_here' || empty(env('DEEPL_KEY'))) {
            $this->error('❌ Please set your DeepL API key in .env file!');
            $this->info('Set DEEPL_KEY="your_api_key_here" in .env');
            $this->info('Get your free API key at: https://www.deepl.com/pro-api');
            return 1;
        }

        $this->info('🚀 Starting translation process with DeepL...');
        
        // Primer, analitzem quantes traduccions falten
        $this->analyzeTranslationGaps();
        
        // Test DeepL connection només si cal fer traduccions
        $needsTranslation = $this->countMissingDeepLTranslations();
        if ($needsTranslation > 0) {
            try {
                $testResult = $this->translateWithDeepL('Hello', 'ES');
                $this->info('✅ DeepL API connection successful');
            } catch (\Exception $e) {
                $this->error('❌ DeepL API connection failed: ' . $e->getMessage());
                return 1;
            }
        } else {
            $this->info('ℹ️  No DeepL translations needed - all covered!');
        }

        // Decidir quants productes processar
        $limit = $this->option('all') ? null : 5;
        $products = $this->getProductsNeedingTranslations($limit);
        
        if ($products->isEmpty()) {
            $this->info('🎉 All translations are complete! Nothing to do.');
            return 0;
        }

        $this->info("📋 Processing {$products->count()} products that need translations...");
        
        $totalAdded = 0;
        $totalSkipped = 0;
        $apiCalls = 0;

        $progressBar = $this->output->createProgressBar($products->count());

        foreach ($products as $product) {
            $existingLocales = $product->translations->pluck('locale')->toArray();
            $missingLocales = array_diff($this->supportedLocales, $existingLocales);

            if (empty($missingLocales)) {
                $this->line("✅ Complete: {$product->name} (all translations exist)");
                $totalSkipped++;
                $progressBar->advance();
                continue;
            }

            foreach ($missingLocales as $locale) {
                // Doble verificació per evitar duplicats
                $existing = ProductTranslation::where('product_id', $product->id)
                    ->where('locale', $locale)
                    ->exists();
                    
                if ($existing) {
                    $this->line("⏭️  Skipped {$locale}: {$product->name} (already exists)");
                    $totalSkipped++;
                    continue;
                }

                if ($locale === 'ca') {
                    // Català: crear traducció manual placeholder
                    $translatedName = $this->createCatalanFallback($product->name);
                    $translatedDescription = $this->createCatalanFallback($product->description);
                    
                    $this->line("📝 CA (manual): {$product->name} → {$translatedName}");
                } else {
                    // Fer traducció amb DeepL
                    try {
                        $translatedName = $this->translateWithDeepL($product->name, strtoupper($locale));
                        $translatedDescription = $this->translateWithDeepL($product->description, strtoupper($locale));
                        $apiCalls += 2; // 2 calls per producte (nom + descripció)
                        
                        $this->line("🤖 {$locale}: {$product->name} → {$translatedName}");
                        
                        // Delay per no sobrecarregar l'API
                        usleep(200000); // 0.2 segons
                        
                    } catch (\Exception $e) {
                        $this->error("❌ Error translating {$product->name} to {$locale}: " . $e->getMessage());
                        continue;
                    }
                }

                // Crear traducció si no estem en mode test
                if (!$this->option('test')) {
                    ProductTranslation::create([
                        'product_id' => $product->id,
                        'locale' => $locale,
                        'name' => $translatedName,
                        'description' => $translatedDescription
                    ]);
                }
                
                $totalAdded++;
            }
            
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        // Estadístiques finals
        if ($this->option('test')) {
            $this->info("🧪 TEST MODE: Would add {$totalAdded} translations");
        } else {
            $this->info("✅ Successfully added {$totalAdded} translations!");
        }
        
        $this->info("📊 Statistics:");
        $this->info("   • API calls made: {$apiCalls}");
        $this->info("   • Translations added: {$totalAdded}");
        $this->info("   • Translations skipped: {$totalSkipped}");
        
        if ($apiCalls > 0) {
            $this->info("💰 Estimated DeepL cost: ~" . ($apiCalls * 20) . " characters used");
        }

        return 0;
    }

    private function analyzeTranslationGaps()
    {
        $this->info('🔍 Analyzing translation gaps...');
        
        $totalProducts = Products::count();
        $totalPossibleTranslations = $totalProducts * count($this->supportedLocales);
        $existingTranslations = ProductTranslation::count();
        $missingTranslations = $totalPossibleTranslations - $existingTranslations;
        
        $this->info("📊 Translation overview:");
        $this->info("   • Total products: {$totalProducts}");
        $this->info("   • Total possible translations: {$totalPossibleTranslations}");
        $this->info("   • Existing translations: {$existingTranslations}");
        $this->info("   • Missing translations: {$missingTranslations}");
        
        // Desglossar per idioma
        foreach ($this->supportedLocales as $locale) {
            $count = ProductTranslation::where('locale', $locale)->count();
            $missing = $totalProducts - $count;
            $percentage = $totalProducts > 0 ? round(($count / $totalProducts) * 100, 1) : 0;
            
            $icon = $missing === 0 ? '✅' : ($missing < 5 ? '⚠️' : '❌');
            $this->info("   • {$icon} {$locale}: {$count}/{$totalProducts} ({$percentage}%) - Missing: {$missing}");
        }
    }

    private function countMissingDeepLTranslations()
    {
        $totalMissing = 0;
        $totalProducts = Products::count();
        
        foreach ($this->deeplLocales as $locale) {
            $existing = ProductTranslation::where('locale', $locale)->count();
            $totalMissing += ($totalProducts - $existing);
        }
        
        return $totalMissing;
    }

    private function getProductsNeedingTranslations($limit = null)
    {
        // Troba tots els productes i filtrarà després
        $query = Products::with('translations');
        
        if ($limit) {
            $query->limit($limit);
        }
        
        $products = $query->get();
        
        // Filtrar per productes que no tenen totes les traduccions
        return $products->filter(function($product) {
            $existingLocales = $product->translations->pluck('locale')->toArray();
            $missingLocales = array_diff($this->supportedLocales, $existingLocales);
            return !empty($missingLocales);
        });
    }

    private function translateWithDeepL($text, $targetLang)
    {
        $apiKey = env('DEEPL_KEY');
        $url = 'https://api-free.deepl.com/v2/translate';
        
        // Mapeig d'idiomes per DeepL
        $langMapping = [
            'ES' => 'ES',
            'EN' => 'EN-GB', 
            'FR' => 'FR',
            'DE' => 'DE'
        ];
        
        $targetLang = $langMapping[$targetLang] ?? $targetLang;
        
        $response = Http::withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . $apiKey,
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->asForm()->post($url, [
            'text' => $text,
            'source_lang' => 'ES', 
            'target_lang' => $targetLang
        ]);

        if (!$response->successful()) {
            throw new \Exception('DeepL API error: ' . $response->body());
        }

        $data = $response->json();
        
        if (!isset($data['translations'][0]['text'])) {
            throw new \Exception('Invalid DeepL response format');
        }

        return $data['translations'][0]['text'];
    }

    private function createCatalanFallback($text)
    {
        $translations = [
            'Combo Estrella' => 'Combo Estrella',
            'Crispy Burger' => 'Hamburguesa Cruixent',
            '4 Quesos' => '4 Formatges',
            'Barbacoa' => 'Barbacoa',
            'Doble Pepperoni' => 'Doble Pepperoni',
            'Xampinyons' => 'Xampinyons',
            'Hot Dog' => 'Hot Dog',
            'Agua' => 'Aigua',
            'Agua con gas' => 'Aigua amb gas',
            'Coca-cola' => 'Coca-cola',
            'Fanta Naranja' => 'Fanta Taronja',
            'Fanta Limón' => 'Fanta Llimona',
            'Patatas Fritas' => 'Patates Fregides',
            'Patatas Bravas' => 'Patates Braves',
            'Chicken Nuggets' => 'Nuggets de Pollastre',
            'Helado Pixelado' => 'Gelat Pixelat',
        ];

        return $translations[$text] ?? $text . ' (CA)';
    }
}
