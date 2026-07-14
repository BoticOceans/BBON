<?php

namespace Database\Seeders;

use App\Models\HomepageBlock;
use Illuminate\Database\Seeder;

class HomepageBlockSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            'marquee' => [
                ['title' => '30+ Years Experience'],
                ['title' => 'Custom Branding'],
                ['title' => 'Retail & Bulk Orders'],
                ['title' => 'Mumbai Based'],
                ['title' => 'Logo / Name / Number Printing'],
                ['title' => 'Premium Fabric Quality'],
                ['title' => 'Team Design Mockups'],
            ],
            'techniques' => [
                ['title' => 'Logo Printing'],
                ['title' => 'Name Printing'],
                ['title' => 'Number Printing'],
                ['title' => 'Front & Back Print'],
                ['title' => 'Full Digital Jersey Print'],
                ['title' => 'Embroidery'],
                ['title' => 'Sublimation'],
                ['title' => 'Screen Printing'],
                ['title' => 'Heat Transfer'],
                ['title' => 'Custom Colors'],
                ['title' => 'Custom Fabric'],
                ['title' => 'Team Design Mockup'],
            ],
            'services' => [
                ['title' => 'Corporates', 'description' => 'Sports days, off-sites, branded uniforms.'],
                ['title' => 'Sports Teams', 'description' => 'Cricket, football, basketball jerseys.'],
                ['title' => 'Gyms & Fitness', 'description' => 'Trainer kits, member merchandise.'],
                ['title' => 'Schools & Colleges', 'description' => 'House tees, PT kits, tournament gear.'],
                ['title' => 'Clubs', 'description' => 'Members-only branded apparel sets.'],
                ['title' => 'Event Organisers', 'description' => 'Marathons, tournaments, fests.'],
                ['title' => 'Retail Customers', 'description' => 'Individual orders welcome too.'],
                ['title' => 'Bulk Distributors', 'description' => 'Wholesale and resale pricing.'],
            ],
            'features' => [
                ['title' => '30+ Years', 'description' => 'Sportswear Crafting'],
                ['title' => 'Quality Fabric', 'description' => 'Tested & Trusted'],
                ['title' => 'In-house Production', 'description' => 'Full Control'],
                ['title' => 'Custom Branding', 'description' => 'Logo - Name - Number'],
            ],
            'process_steps' => [
                ['title' => 'Share Requirement', 'description' => 'Tell us product, quantity, fabric & branding needs over WhatsApp or call.'],
                ['title' => 'Select Product & Fabric', 'description' => 'Pick from our catalogue or specify a custom fabric & cut.'],
                ['title' => 'Approve Design / Mockup', 'description' => 'Our team prepares a digital mockup with your logo, names & numbers.'],
                ['title' => 'Production & Delivery', 'description' => 'We manufacture, quality-check and dispatch on agreed timelines.'],
            ],
        ];

        foreach ($groups as $group => $items) {
            foreach ($items as $index => $item) {
                HomepageBlock::query()->updateOrCreate(
                    ['group' => $group, 'title' => $item['title']],
                    [
                        'description' => $item['description'] ?? null,
                        'sort_order' => $index,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
