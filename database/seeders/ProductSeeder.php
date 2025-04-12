<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Produits de nutrition
            [
                'title' => 'Créatine Monohydrate',
                'description' => 'Créatine pure monohydrate 300g. Augmente la force et la masse musculaire. Sans additifs ni conservateurs.',
                'type' => 'nutrition',
                'price' => 29.99,
                'quantity' => 50,
                'image' => 'creatine.jpg'
            ],
            [
                'title' => 'Whey Protein Premium',
                'description' => 'Protéine de lactosérum 2kg, 80% de protéines. Goût vanille. Idéal pour la récupération musculaire.',
                'type' => 'nutrition',
                'price' => 49.99,
                'quantity' => 30,
                'image' => 'whey.jpg'
            ],
            [
                'title' => 'BCAA 2:1:1',
                'description' => 'Acides aminés essentiels en ratio 2:1:1. 300g. Aide à la récupération et prévient le catabolisme musculaire.',
                'type' => 'nutrition',
                'price' => 24.99,
                'quantity' => 40,
                'image' => 'bcaa.jpg'
            ],

            // Vêtements
            [
                'title' => 'T-shirt Performance',
                'description' => 'T-shirt technique 100% polyester. Respirant et léger. Disponible en plusieurs couleurs.',
                'type' => 'vetement',
                'price' => 24.99,
                'quantity' => 100,
                'image' => 'tshirt.jpg'
            ],
            [
                'title' => 'Short de Training',
                'description' => 'Short de sport élastique avec poche zippée. Matière légère et respirante.',
                'type' => 'vetement',
                'price' => 19.99,
                'quantity' => 80,
                'image' => 'short.jpg'
            ],
            [
                'title' => 'Legging Femme',
                'description' => 'Legging de sport haute compression. Taille haute avec ceinture élastique.',
                'type' => 'vetement',
                'price' => 34.99,
                'quantity' => 60,
                'image' => 'legging.jpg'
            ],

            // Accessoires
            [
                'title' => 'Gants de Musculation',
                'description' => 'Gants de musculation avec rembourrage. Protection des paumes et meilleure prise.',
                'type' => 'accessoire',
                'price' => 14.99,
                'quantity' => 70,
                'image' => 'gants.jpg'
            ],
            [
                'title' => 'Ceinture de Force',
                'description' => 'Ceinture de force en cuir. Support lombaire pour les exercices lourds.',
                'type' => 'accessoire',
                'price' => 39.99,
                'quantity' => 40,
                'image' => 'ceinture.jpg'
            ],
            [
                'title' => 'Sangle de Traction',
                'description' => 'Sangle de traction en nylon renforcé. Longueur 1.5m, résistance 300kg.',
                'type' => 'accessoire',
                'price' => 9.99,
                'quantity' => 90,
                'image' => 'sangle.jpg'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 