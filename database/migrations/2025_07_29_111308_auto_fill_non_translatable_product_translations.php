<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Products;
use App\Models\ProductTranslation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Obtenir tots els productes marcats com a no traduïbles
        $nonTranslatableProducts = Products::where('no_traduible', true)->get();
        
        $locales = ['ca', 'es', 'en', 'fr', 'de'];
        
        foreach ($nonTranslatableProducts as $product) {
            foreach ($locales as $locale) {
                ProductTranslation::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'locale' => $locale
                    ],
                    [
                        'name' => $product->name,
                        'description' => $product->description
                    ]
                );
            }
        }
        
        echo "Processed " . $nonTranslatableProducts->count() . " non-translatable products\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse action needed for this migration
    }
};
