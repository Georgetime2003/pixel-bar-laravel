<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;
use App\Models\ProductsCategory;
use App\Models\Label;
use App\Models\ProductTranslation;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        // Crear categories
        $categories = [
            ['name' => 'Combos', 'description' => 'Combos especials del restaurant'],
            ['name' => 'Hamburguesas', 'description' => 'Hamburguesas artesanals'],
            ['name' => 'Pizzas', 'description' => 'Pizzes variades'],
            ['name' => 'Hot Dogs', 'description' => 'Hot dogs casolans'],
            ['name' => 'Bebidas', 'description' => 'Begudes refrescants'],
            ['name' => 'Cerveza', 'description' => 'Cerveses nacionals i internacionals'],
            ['name' => 'Aperitivos', 'description' => 'Aperitius per compartir'],
            ['name' => 'Postres', 'description' => 'Postres casolanes'],
        ];

        foreach ($categories as $category) {
            ProductsCategory::create($category);
        }

        // Crear etiquetes
        $labels = [
            ['name' => 'Estrella', 'icon' => '⭐', 'color' => '#FFD700'],
            ['name' => 'Popular', 'icon' => '🔥', 'color' => '#FF6B6B'],
            ['name' => 'Nou', 'icon' => '✨', 'color' => '#4ECDC4'],
            ['name' => 'Especial', 'icon' => '👑', 'color' => '#9B59B6'],
        ];

        foreach ($labels as $label) {
            Label::create($label);
        }

        // Productes amb traduccions
        $products = [
            // COMBOS
            [
                'name' => 'Combo Estrella',
                'description' => 'Hamburguesa Crispy o Pizza + Patates + Refresco o Cervesa',
                'price' => 10.00,
                'category_id' => 1,
                'label_id' => 1,
                'translations' => [
                    'ca' => ['name' => 'Combo Estrella', 'description' => 'Hamburguesa Crispy o Pizza + Patates + Refresc o Cervesa'],
                    'en' => ['name' => 'Star Combo', 'description' => 'Crispy Burger or Pizza + Fries + Soft drink or Beer'],
                    'es' => ['name' => 'Combo Estrella', 'description' => 'Hamburguesa Crispy o Pizza + Patatas + Refresco o Cerveza'],
                ]
            ],
            
            // HAMBURGUESAS
            [
                'name' => 'Crispy Burger',
                'description' => 'Hamburguesa cruixent amb ingredients frescos',
                'price' => 7.50,
                'category_id' => 2,
                'label_id' => 2,
                'translations' => [
                    'ca' => ['name' => 'Crispy Burger', 'description' => 'Hamburguesa cruixent amb ingredients frescos'],
                    'en' => ['name' => 'Crispy Burger', 'description' => 'Crispy burger with fresh ingredients'],
                    'es' => ['name' => 'Crispy Burger', 'description' => 'Hamburguesa crujiente con ingredientes frescos'],
                ]
            ],
            
            // PIZZAS
            [
                'name' => '4 Quesos',
                'description' => 'Mozzarella, Gorgonzola, Parmesano, Queso de cabra',
                'price' => 8.50,
                'category_id' => 3,
                'label_id' => 2,
                'translations' => [
                    'ca' => ['name' => '4 Formatges', 'description' => 'Mozzarella, Gorgonzola, Parmesà, Formatge de cabra'],
                    'en' => ['name' => '4 Cheeses', 'description' => 'Mozzarella, Gorgonzola, Parmesan, Goat cheese'],
                    'es' => ['name' => '4 Quesos', 'description' => 'Mozzarella, Gorgonzola, Parmesano, Queso de cabra'],
                ]
            ],
            [
                'name' => 'Barbacoa',
                'description' => 'Salsa BBQ, mozzarella, Pollo, Cebolla morada, Bacon',
                'price' => 8.50,
                'category_id' => 3,
                'label_id' => 2,
                'translations' => [
                    'ca' => ['name' => 'Barbacoa', 'description' => 'Salsa BBQ, mozzarella, Pollastre, Ceba morada, Bacon'],
                    'en' => ['name' => 'BBQ', 'description' => 'BBQ sauce, mozzarella, Chicken, Red onion, Bacon'],
                    'es' => ['name' => 'Barbacoa', 'description' => 'Salsa BBQ, mozzarella, Pollo, Cebolla morada, Bacon'],
                ]
            ],
            [
                'name' => 'Doble Pepperoni',
                'description' => 'Mozzarella amb doble de pepperoni',
                'price' => 8.50,
                'category_id' => 3,
                'label_id' => 2,
                'translations' => [
                    'ca' => ['name' => 'Doble Pepperoni', 'description' => 'Mozzarella amb doble de pepperoni'],
                    'en' => ['name' => 'Double Pepperoni', 'description' => 'Mozzarella with double pepperoni'],
                    'es' => ['name' => 'Doble Pepperoni', 'description' => 'Mozzarella con doble pepperoni'],
                ]
            ],
            [
                'name' => 'Xampinyons',
                'description' => 'Pernil dolç, formatge, xampinyons',
                'price' => 8.50,
                'category_id' => 3,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Xampinyons', 'description' => 'Pernil dolç, formatge, xampinyons'],
                    'en' => ['name' => 'Mushrooms', 'description' => 'Sweet ham, cheese, mushrooms'],
                    'es' => ['name' => 'Champiñones', 'description' => 'Jamón dulce, queso, champiñones'],
                ]
            ],
            
            // HOT DOGS
            [
                'name' => 'Hot Dog',
                'description' => 'Hot dog clàssic amb ingredients tradicionals',
                'price' => 4.50,
                'category_id' => 4,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Hot Dog', 'description' => 'Hot dog clàssic amb ingredients tradicionals'],
                    'en' => ['name' => 'Hot Dog', 'description' => 'Classic hot dog with traditional ingredients'],
                    'es' => ['name' => 'Hot Dog', 'description' => 'Hot dog clásico con ingredientes tradicionales'],
                ]
            ],
            
            // BEBIDAS
            [
                'name' => 'Agua',
                'description' => 'Aigua natural',
                'price' => 2.30,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Aigua', 'description' => 'Aigua natural'],
                    'en' => ['name' => 'Water', 'description' => 'Natural water'],
                    'es' => ['name' => 'Agua', 'description' => 'Agua natural'],
                ]
            ],
            [
                'name' => 'Agua con gas',
                'description' => 'Aigua amb gas',
                'price' => 2.30,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Aigua amb gas', 'description' => 'Aigua amb gas'],
                    'en' => ['name' => 'Sparkling water', 'description' => 'Sparkling water'],
                    'es' => ['name' => 'Agua con gas', 'description' => 'Agua con gas'],
                ]
            ],
            [
                'name' => 'Coca-cola',
                'description' => 'Coca-Cola clàssica',
                'price' => 2.80,
                'category_id' => 5,
                'label_id' => 2,
                'translations' => [
                    'ca' => ['name' => 'Coca-cola', 'description' => 'Coca-Cola clàssica'],
                    'en' => ['name' => 'Coca-cola', 'description' => 'Classic Coca-Cola'],
                    'es' => ['name' => 'Coca-cola', 'description' => 'Coca-Cola clásica'],
                ]
            ],
            [
                'name' => 'Coca-cola Zero',
                'description' => 'Coca-Cola sense sucre',
                'price' => 2.80,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Coca-cola Zero', 'description' => 'Coca-Cola sense sucre'],
                    'en' => ['name' => 'Coca-cola Zero', 'description' => 'Sugar-free Coca-Cola'],
                    'es' => ['name' => 'Coca-cola Zero', 'description' => 'Coca-Cola sin azúcar'],
                ]
            ],
            [
                'name' => 'Fanta Naranja',
                'description' => 'Refresc de taronja',
                'price' => 2.80,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Fanta Taronja', 'description' => 'Refresc de taronja'],
                    'en' => ['name' => 'Fanta Orange', 'description' => 'Orange soft drink'],
                    'es' => ['name' => 'Fanta Naranja', 'description' => 'Refresco de naranja'],
                ]
            ],
            [
                'name' => 'Fanta Limón',
                'description' => 'Refresc de llimona',
                'price' => 2.80,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Fanta Llimona', 'description' => 'Refresc de llimona'],
                    'en' => ['name' => 'Fanta Lemon', 'description' => 'Lemon soft drink'],
                    'es' => ['name' => 'Fanta Limón', 'description' => 'Refresco de limón'],
                ]
            ],
            [
                'name' => 'Nestea',
                'description' => 'Te fred amb llimona',
                'price' => 2.80,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Nestea', 'description' => 'Te fred amb llimona'],
                    'en' => ['name' => 'Nestea', 'description' => 'Iced tea with lemon'],
                    'es' => ['name' => 'Nestea', 'description' => 'Té frío con limón'],
                ]
            ],
            [
                'name' => 'Redbull',
                'description' => 'Beguda energètica',
                'price' => 3.00,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Redbull', 'description' => 'Beguda energètica'],
                    'en' => ['name' => 'Redbull', 'description' => 'Energy drink'],
                    'es' => ['name' => 'Redbull', 'description' => 'Bebida energética'],
                ]
            ],
            [
                'name' => 'Monster',
                'description' => 'Beguda energètica',
                'price' => 3.00,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Monster', 'description' => 'Beguda energètica'],
                    'en' => ['name' => 'Monster', 'description' => 'Energy drink'],
                    'es' => ['name' => 'Monster', 'description' => 'Bebida energética'],
                ]
            ],
            [
                'name' => 'Zumos',
                'description' => 'Sucs naturals',
                'price' => 2.50,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Sucs', 'description' => 'Sucs naturals'],
                    'en' => ['name' => 'Juices', 'description' => 'Natural juices'],
                    'es' => ['name' => 'Zumos', 'description' => 'Zumos naturales'],
                ]
            ],
            [
                'name' => 'Tónica',
                'description' => 'Aigua tònica',
                'price' => 2.80,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Tònica', 'description' => 'Aigua tònica'],
                    'en' => ['name' => 'Tonic', 'description' => 'Tonic water'],
                    'es' => ['name' => 'Tónica', 'description' => 'Agua tónica'],
                ]
            ],
            [
                'name' => 'Batido Cacao',
                'description' => 'Batut de cacau',
                'price' => 2.90,
                'category_id' => 5,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Batut de Cacau', 'description' => 'Batut de cacau'],
                    'en' => ['name' => 'Chocolate Shake', 'description' => 'Chocolate milkshake'],
                    'es' => ['name' => 'Batido Cacao', 'description' => 'Batido de cacao'],
                ]
            ],
            
            // CERVEZA
            [
                'name' => 'Alhambra 20 CL',
                'description' => 'Cervesa Alhambra 20cl',
                'price' => 2.40,
                'category_id' => 6,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Alhambra 20 CL', 'description' => 'Cervesa Alhambra 20cl'],
                    'en' => ['name' => 'Alhambra 20 CL', 'description' => 'Alhambra beer 20cl'],
                    'es' => ['name' => 'Alhambra 20 CL', 'description' => 'Cerveza Alhambra 20cl'],
                ]
            ],
            [
                'name' => 'Alhambra 33 CL',
                'description' => 'Cervesa Alhambra 33cl',
                'price' => 2.80,
                'category_id' => 6,
                'label_id' => 2,
                'translations' => [
                    'ca' => ['name' => 'Alhambra 33 CL', 'description' => 'Cervesa Alhambra 33cl'],
                    'en' => ['name' => 'Alhambra 33 CL', 'description' => 'Alhambra beer 33cl'],
                    'es' => ['name' => 'Alhambra 33 CL', 'description' => 'Cerveza Alhambra 33cl'],
                ]
            ],
            [
                'name' => 'Alhambra Reserva',
                'description' => 'Cervesa Alhambra Reserva',
                'price' => 3.00,
                'category_id' => 6,
                'label_id' => 4,
                'translations' => [
                    'ca' => ['name' => 'Alhambra Reserva', 'description' => 'Cervesa Alhambra Reserva'],
                    'en' => ['name' => 'Alhambra Reserve', 'description' => 'Alhambra Reserve beer'],
                    'es' => ['name' => 'Alhambra Reserva', 'description' => 'Cerveza Alhambra Reserva'],
                ]
            ],
            [
                'name' => 'Estrella Galicia',
                'description' => 'Cervesa Estrella Galicia',
                'price' => 2.80,
                'category_id' => 6,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Estrella Galicia', 'description' => 'Cervesa Estrella Galicia'],
                    'en' => ['name' => 'Estrella Galicia', 'description' => 'Estrella Galicia beer'],
                    'es' => ['name' => 'Estrella Galicia', 'description' => 'Cerveza Estrella Galicia'],
                ]
            ],
            [
                'name' => 'Volldamm',
                'description' => 'Cervesa Volldamm',
                'price' => 3.00,
                'category_id' => 6,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Volldamm', 'description' => 'Cervesa Volldamm'],
                    'en' => ['name' => 'Volldamm', 'description' => 'Volldamm beer'],
                    'es' => ['name' => 'Volldamm', 'description' => 'Cerveza Volldamm'],
                ]
            ],
            [
                'name' => 'Corona',
                'description' => 'Cervesa Corona',
                'price' => 3.20,
                'category_id' => 6,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Corona', 'description' => 'Cervesa Corona'],
                    'en' => ['name' => 'Corona', 'description' => 'Corona beer'],
                    'es' => ['name' => 'Corona', 'description' => 'Cerveza Corona'],
                ]
            ],
            [
                'name' => 'Desperados',
                'description' => 'Cervesa amb tequila',
                'price' => 3.20,
                'category_id' => 6,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Desperados', 'description' => 'Cervesa amb tequila'],
                    'en' => ['name' => 'Desperados', 'description' => 'Beer with tequila'],
                    'es' => ['name' => 'Desperados', 'description' => 'Cerveza con tequila'],
                ]
            ],
            [
                'name' => 'Asahi',
                'description' => 'Cervesa japonesa',
                'price' => 3.20,
                'category_id' => 6,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Asahi', 'description' => 'Cervesa japonesa'],
                    'en' => ['name' => 'Asahi', 'description' => 'Japanese beer'],
                    'es' => ['name' => 'Asahi', 'description' => 'Cerveza japonesa'],
                ]
            ],
            [
                'name' => 'Hidromiel',
                'description' => 'Beguda alcohòlica de mel',
                'price' => 5.20,
                'category_id' => 6,
                'label_id' => 4,
                'translations' => [
                    'ca' => ['name' => 'Hidromiel', 'description' => 'Beguda alcohòlica de mel'],
                    'en' => ['name' => 'Mead', 'description' => 'Honey alcoholic beverage'],
                    'es' => ['name' => 'Hidromiel', 'description' => 'Bebida alcohólica de miel'],
                ]
            ],
            
            // APERITIVOS
            [
                'name' => 'Patatas Fritas',
                'description' => 'Patates fregides amb sal',
                'price' => 5.00,
                'category_id' => 7,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Patates Fregides', 'description' => 'Patates fregides amb sal'],
                    'en' => ['name' => 'French Fries', 'description' => 'Fried potatoes with salt'],
                    'es' => ['name' => 'Patatas Fritas', 'description' => 'Patatas fritas con sal'],
                ]
            ],
            [
                'name' => 'Patatas Bravas',
                'description' => 'Patates amb salsa brava',
                'price' => 5.75,
                'category_id' => 7,
                'label_id' => 2,
                'translations' => [
                    'ca' => ['name' => 'Patates Braves', 'description' => 'Patates amb salsa brava'],
                    'en' => ['name' => 'Bravas Potatoes', 'description' => 'Potatoes with spicy sauce'],
                    'es' => ['name' => 'Patatas Bravas', 'description' => 'Patatas con salsa brava'],
                ]
            ],
            [
                'name' => 'Patatas J & Q',
                'description' => 'Patates amb pernil i formatge',
                'price' => 6.00,
                'category_id' => 7,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Patates P & F', 'description' => 'Patates amb pernil i formatge'],
                    'en' => ['name' => 'Ham & Cheese Potatoes', 'description' => 'Potatoes with ham and cheese'],
                    'es' => ['name' => 'Patatas J & Q', 'description' => 'Patatas con jamón y queso'],
                ]
            ],
            [
                'name' => 'Nachos',
                'description' => 'Nachos amb guacamole i formatge',
                'price' => 8.75,
                'category_id' => 7,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Nachos', 'description' => 'Nachos amb guacamole i formatge'],
                    'en' => ['name' => 'Nachos', 'description' => 'Nachos with guacamole and cheese'],
                    'es' => ['name' => 'Nachos', 'description' => 'Nachos con guacamole y queso'],
                ]
            ],
            [
                'name' => 'Takoyaki',
                'description' => 'Boletes japoneses de pop (6U)',
                'price' => 7.00,
                'category_id' => 7,
                'label_id' => 4,
                'translations' => [
                    'ca' => ['name' => 'Takoyaki', 'description' => 'Boletes japoneses de pop (6U)'],
                    'en' => ['name' => 'Takoyaki', 'description' => 'Japanese octopus balls (6U)'],
                    'es' => ['name' => 'Takoyaki', 'description' => 'Bolitas japonesas de pulpo (6U)'],
                ]
            ],
            [
                'name' => 'Gyozas',
                'description' => 'Gyozas de carn o verdura (4U)',
                'price' => 7.00,
                'category_id' => 7,
                'label_id' => 4,
                'translations' => [
                    'ca' => ['name' => 'Gyozas', 'description' => 'Gyozas de carn o verdura (4U)'],
                    'en' => ['name' => 'Gyozas', 'description' => 'Meat or vegetable gyozas (4U)'],
                    'es' => ['name' => 'Gyozas', 'description' => 'Gyozas de carne o verdura (4U)'],
                ]
            ],
            [
                'name' => 'Chicken Nuggets',
                'description' => 'Nuggets de pollastre',
                'price' => 4.50,
                'category_id' => 7,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Nuggets de Pollastre', 'description' => 'Nuggets de pollastre'],
                    'en' => ['name' => 'Chicken Nuggets', 'description' => 'Chicken nuggets'],
                    'es' => ['name' => 'Nuggets de Pollo', 'description' => 'Nuggets de pollo'],
                ]
            ],
            [
                'name' => 'Mochi',
                'description' => 'Mochi de te matcha',
                'price' => 4.50,
                'category_id' => 7,
                'label_id' => 4,
                'translations' => [
                    'ca' => ['name' => 'Mochi', 'description' => 'Mochi de te matcha'],
                    'en' => ['name' => 'Mochi', 'description' => 'Matcha tea mochi'],
                    'es' => ['name' => 'Mochi', 'description' => 'Mochi de té matcha'],
                ]
            ],
            [
                'name' => 'Coulant',
                'description' => 'Coulant de xocolata',
                'price' => 4.50,
                'category_id' => 7,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Coulant', 'description' => 'Coulant de xocolata'],
                    'en' => ['name' => 'Chocolate Lava Cake', 'description' => 'Chocolate lava cake'],
                    'es' => ['name' => 'Coulant', 'description' => 'Coulant de chocolate'],
                ]
            ],
            
            // POSTRES
            [
                'name' => 'Pixel Cake',
                'description' => 'Deliciós pastís de xocolata amb trossos de píxel',
                'price' => 4.00,
                'category_id' => 8,
                'label_id' => 4,
                'translations' => [
                    'ca' => ['name' => 'Pixel Cake', 'description' => 'Deliciós pastís de xocolata amb trossos de píxel'],
                    'en' => ['name' => 'Pixel Cake', 'description' => 'Delicious chocolate cake with pixel pieces'],
                    'es' => ['name' => 'Pixel Cake', 'description' => 'Delicioso pastel de chocolate con trozos de pixel'],
                ]
            ],
            [
                'name' => 'Helado Pixelado',
                'description' => 'Gelat de vainilla amb xips de xocolata',
                'price' => 3.50,
                'category_id' => 8,
                'label_id' => null,
                'translations' => [
                    'ca' => ['name' => 'Gelat Pixelat', 'description' => 'Gelat de vainilla amb xips de xocolata'],
                    'en' => ['name' => 'Pixelated Ice Cream', 'description' => 'Vanilla ice cream with chocolate chips'],
                    'es' => ['name' => 'Helado Pixelado', 'description' => 'Helado de vainilla con chispas de chocolate'],
                ]
            ],
        ];

        // Crear productes amb traduccions
        foreach ($products as $productData) {
            $translations = $productData['translations'];
            unset($productData['translations']);
            
            $product = Products::create($productData);
            
            // Crear traduccions
            foreach ($translations as $locale => $translation) {
                ProductTranslation::create([
                    'product_id' => $product->id,
                    'locale' => $locale,
                    'name' => $translation['name'],
                    'description' => $translation['description']
                ]);
            }
        }
    }
}
