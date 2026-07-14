<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['Custom Red Jersey', 'Jerseys', 'Custom team jersey with full-colour performance styling.', 'assets/images/images-unsplash-com-photo-1577212017308-55c4d60d2609-f2dbc0d6217d.jpg', true],
            ['Polo T-Shirt', 'T-Shirts', 'Professional branded polo for teams and corporates.', 'assets/images/images-unsplash-com-photo-1586363104862-3a5e2ab60d99-1da9c71c1067.jpg', false],
            ['Training Track Pants', 'Track Pants', 'Made-to-order track pants for training and team kits.', 'assets/images/images-unsplash-com-photo-1552902865-b72c031ac5ea-40a903c22b13.jpg', false],
            ['Sports Shorts', 'Shorts', 'Lightweight custom shorts for sport and fitness.', 'assets/images/images-unsplash-com-photo-1591195853828-11db59a44f6b-919a20230bf0.jpg', false],
            ['Sports Jacket', 'Jackets', 'Custom outerwear for clubs, teams and businesses.', 'assets/images/images-unsplash-com-photo-1551488831-00ddcb6c6bd3-b8cb09f010b5.jpg', false],
            ['Round Neck T-Shirt', 'T-Shirts', 'Everyday custom t-shirt with bulk branding options.', 'assets/images/images-unsplash-com-photo-1521572163474-6864f9cf17ab-2c53818fc904.jpg', false],
            ['Training Environment', 'Custom Designs', 'Performance wear made for active teams.', 'assets/images/images-unsplash-com-photo-1571902943202-507ec2618e8f-5e2c843d0dbb.jpg', false],
            ['Embroidery Detail', 'Custom Designs', 'Clean embroidery and logo finishing.', 'assets/images/images-unsplash-com-photo-1558769132-cb1aea458c5e-9649d55035b1.jpg', false],
            ['Print Detail', 'Custom Designs', 'Durable print detail for made-to-order clothing.', 'assets/images/images-unsplash-com-photo-1620799140408-edc6dcb6d633-c1355c6da9c4.jpg', false],
            ['Tipping Collar Tee', 'T-Shirts', 'Premium collar detailing and team colours.', 'assets/images/images-unsplash-com-photo-1567401893414-76b7b1e5a7a5-b9cc4f93cfbe.jpg', false],
        ];

        foreach ($items as $index => [$title, $category, $caption, $imagePath, $featured]) {
            GalleryItem::updateOrCreate(
                ['title' => $title],
                [
                    'category' => $category,
                    'caption' => $caption,
                    'image_path' => $imagePath,
                    'alt_text' => $title,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                    'is_featured' => $featured,
                ]
            );
        }
    }
}
