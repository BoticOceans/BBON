<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            [
                'name' => 'T-Shirts',
                'slug' => 't-shirts',
                'description' => 'Round neck, polo and collar t-shirts.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Jerseys',
                'slug' => 'jerseys',
                'description' => 'Custom team jerseys with names, numbers and full-print options.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Bottom Wear',
                'slug' => 'bottom-wear',
                'description' => 'Track pants and shorts for teams, gyms and corporate sports.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Jackets',
                'slug' => 'jackets',
                'description' => 'Custom jackets for teams, corporates and branded sets.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Custom Sets',
                'slug' => 'custom-sets',
                'description' => 'Full tracksuit sets, co-ord kits and uniform bundles.',
                'sort_order' => 5,
            ],
        ])->mapWithKeys(function (array $category): array {
            $model = ProductCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category + ['is_active' => true]
            );

            return [$category['slug'] => $model];
        });

        $products = [
            [
                'category' => 't-shirts',
                'name' => 'Round Neck T-Shirts',
                'slug' => 'round-neck-t-shirts',
                'short_description' => 'Comfortable regular-fit t-shirts for retail wear, events, uniforms, gym wear and promotional branding.',
                'description' => 'Made-to-order round neck t-shirts with logo printing, screen printing, sublimation and custom colour options.',
                'image_path' => 'assets/images/images-unsplash-com-photo-1521572163474-6864f9cf17ab-2c53818fc904.jpg',
                'fabric' => 'Premium polyester, dry-fit, cotton blends and custom fabric on request.',
                'sizes' => 'XS - 5XL, kids sizes available and custom sizing on bulk orders.',
                'best_for' => ['Events', 'Retail', 'Promotions', 'Gym Wear'],
                'customisations' => ['Logo Print', 'Screen Print', 'Sublimation', 'Custom Colors'],
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'category' => 't-shirts',
                'name' => 'Polo T-Shirts',
                'slug' => 'polo-t-shirts',
                'short_description' => 'Professional sports polos for corporates, clubs and teams.',
                'description' => 'Corporate-ready polo t-shirts with clean collars, embroidery, logo print and team colour options.',
                'image_path' => 'assets/images/images-unsplash-com-photo-1586363104862-3a5e2ab60d99-1da9c71c1067.jpg',
                'fabric' => 'Dry-fit pique, cotton blends and performance knits.',
                'sizes' => 'XS - 5XL, custom sizing on bulk orders.',
                'best_for' => ['Corporates', 'Clubs', 'Teams'],
                'customisations' => ['Embroidery', 'Logo Print', 'Team Colors', 'Name Printing'],
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'category' => 't-shirts',
                'name' => 'Tipping Collar T-Shirts',
                'slug' => 'tipping-collar-t-shirts',
                'short_description' => 'Contrast-tipped collars for premium corporate sports days.',
                'description' => 'Premium t-shirts with contrast collar and sleeve tipping for corporate sports and team wear.',
                'image_path' => 'assets/images/images-unsplash-com-photo-1618354691373-d851c5c3a990-050246dbdf45.jpg',
                'fabric' => 'Polo knits with contrast collar and sleeve tipping.',
                'sizes' => 'XS - 5XL.',
                'best_for' => ['Corporate Sports Day', 'Team Wear'],
                'customisations' => ['Embroidery', 'Contrast Tipping', 'Logo Print'],
                'sort_order' => 3,
                'is_featured' => false,
            ],
            [
                'category' => 'jerseys',
                'name' => 'Sports Jerseys',
                'slug' => 'sports-jerseys',
                'short_description' => 'Fully custom jerseys with name, number and full-print options.',
                'description' => 'Team jerseys for cricket, football and events with sublimation, digital print, name and number printing.',
                'image_path' => 'assets/images/images-unsplash-com-photo-1577212017308-55c4d60d2609-f2dbc0d6217d.jpg',
                'fabric' => 'Lightweight breathable jersey fabric.',
                'sizes' => 'Kids and adult sizes on order.',
                'best_for' => ['Cricket', 'Football', 'Tournament Teams'],
                'customisations' => ['Full Digital Print', 'Sublimation', 'Name Printing', 'Number Printing'],
                'sort_order' => 4,
                'is_featured' => true,
            ],
            [
                'category' => 'bottom-wear',
                'name' => 'Track Pants',
                'slug' => 'track-pants',
                'short_description' => 'Training and uniform track pants with custom branding.',
                'description' => 'Track pants for teams, gyms, schools and corporate groups with side stripes, logo placement and colour options.',
                'image_path' => 'assets/images/images-unsplash-com-photo-1552902865-b72c031ac5ea-40a903c22b13.jpg',
                'fabric' => 'Polyester, fleece and stretch performance fabrics.',
                'sizes' => 'XS - 5XL.',
                'best_for' => ['Training', 'Travel Kits', 'Teams'],
                'customisations' => ['Logo Print', 'Side Stripes', 'Team Colors'],
                'sort_order' => 5,
                'is_featured' => false,
            ],
            [
                'category' => 'bottom-wear',
                'name' => 'Shorts',
                'slug' => 'shorts',
                'short_description' => 'Lightweight sports shorts for teams, gyms and training.',
                'description' => 'Sports shorts built for training, running and team kits with lightweight fabrics and branding options.',
                'image_path' => 'assets/images/images-unsplash-com-photo-1591195853828-11db59a44f6b-919a20230bf0.jpg',
                'fabric' => 'Dry-fit and lightweight woven fabric.',
                'sizes' => 'XS - 5XL.',
                'best_for' => ['Gyms', 'Running', 'Training'],
                'customisations' => ['Logo Print', 'Number Print', 'Team Colors'],
                'sort_order' => 6,
                'is_featured' => false,
            ],
            [
                'category' => 'jackets',
                'name' => 'Jackets',
                'slug' => 'jackets',
                'short_description' => 'Custom jackets for teams, corporates and branded sets.',
                'description' => 'Custom jackets for sports teams, corporate outings, clubs and branded uniform sets.',
                'image_path' => 'assets/images/images-unsplash-com-photo-1551488831-00ddcb6c6bd3-b8cb09f010b5.jpg',
                'fabric' => 'Fleece, polyester and windcheater fabrics.',
                'sizes' => 'XS - 5XL.',
                'best_for' => ['Corporates', 'Teams', 'Clubs'],
                'customisations' => ['Embroidery', 'Logo Print', 'Full Set Branding'],
                'sort_order' => 7,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'product_category_id' => $categories[$product['category']]->id,
                    'name' => $product['name'],
                    'short_description' => $product['short_description'],
                    'description' => $product['description'],
                    'image_path' => $product['image_path'],
                    'fabric' => $product['fabric'],
                    'sizes' => $product['sizes'],
                    'best_for' => $product['best_for'],
                    'customisations' => $product['customisations'],
                    'sort_order' => $product['sort_order'],
                    'is_active' => true,
                    'is_featured' => $product['is_featured'],
                ]
            );
        }
    }
}
