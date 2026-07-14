<?php

namespace Database\Seeders;

use App\Models\HomepageContent;
use Illuminate\Database\Seeder;

class HomepageContentSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->defaults() as $key => $value) {
            HomepageContent::query()->updateOrInsert(['key' => $key], ['value' => $value]);
        }

        HomepageContent::forget();
    }

    /**
     * @return array<string, string>
     */
    public function defaults(): array
    {
        return [
            // Hero
            'hero_eyebrow' => '30+ Years - Mumbai - Trusted Manufacturer',
            'hero_title_line1' => 'Custom Sportswear',
            'hero_title_line2_pre' => 'Made For',
            'hero_title_highlight' => 'Teams',
            'hero_title_line3' => 'Corporates & Everyday Performance',
            'hero_subtitle' => 'B.BON Sports Wear has been crafting quality sportswear for 30+ years - from custom jerseys and branded t-shirts to track pants, shorts, jackets, and corporate sportswear.',
            'hero_cta_primary_label' => 'Download Catalogue',
            'hero_cta_secondary_label' => 'Call Now',
            'hero_cta_tertiary_label' => 'View Products',
            'hero_stat1_value' => '30+',
            'hero_stat1_label' => 'Years Crafting',
            'hero_stat2_value' => '1000+',
            'hero_stat2_label' => 'Teams Served',
            'hero_stat3_value' => '100%',
            'hero_stat3_label' => 'Custom Built',
            'hero_image' => 'assets/images/images-unsplash-com-photo-1577212017308-55c4d60d2609-f2dbc0d6217d.jpg',
            'hero_image_alt' => 'Custom B.BON jersey',
            'hero_image_badge_label' => 'Featured Build',
            'hero_image_title' => 'Full Sublimation Jersey',
            'hero_image_subtitle' => 'Name - Number - Logo - Full Digital Print',

            // Catalogue preview
            'catalogue_eyebrow' => 'Product Categories',
            'catalogue_title' => 'A Catalogue Built For The Field.',
            'catalogue_subtitle' => 'From everyday tees to fully custom team jerseys - explore the range. All products are customisable with logos, names, numbers and your team colours.',

            // Custom sportswear
            'custom_eyebrow' => 'Custom Sportswear',
            'custom_title_line1' => 'Your Team.',
            'custom_title_line2' => 'Your Brand.',
            'custom_title_highlight' => 'Your Design.',
            'custom_subtitle' => 'B.BON creates custom sportswear for corporates, retail customers, teams, gyms, schools, colleges and sports events. From a single logo print to fully sublimated team kits - we handle every detail.',
            'custom_cta_primary_label' => 'Request Custom Quote',
            'custom_cta_secondary_label' => 'Explore Customisation',
            'custom_image' => 'assets/images/images-unsplash-com-photo-1558769132-cb1aea458c5e-9649d55035b1.jpg',
            'custom_image_alt' => 'Embroidery detail',
            'custom_badge_number' => '12+',
            'custom_badge_label' => 'Printing & Branding Techniques',

            // Who we serve
            'serve_eyebrow' => 'Corporate & Bulk Orders',
            'serve_title' => 'Built For Sports Days, Teams, Clubs & Bulk Requirements.',
            'serve_subtitle' => 'We work with HR teams, sports coordinators, coaches, school sports departments and event organisers across Mumbai and pan-India. Reliable lead times, transparent communication, no surprises.',

            // Gallery preview
            'gallery_eyebrow' => 'Gallery',
            'gallery_title' => 'Real Builds. Real Teams.',
            'gallery_subtitle' => 'A snapshot of recent custom orders - jerseys, polos, track pants and corporate sets.',

            // About preview
            'about_eyebrow' => 'About B.BON',
            'about_title' => '30+ Years of Sportswear Trust.',
            'about_subtitle' => 'B.BON Sports Wear is a Mumbai-based customized sportswear manufacturer with over three decades of experience in quality athletic apparel. From everyday sportswear to fully customized team uniforms, B.BON combines fabric comfort, branding options, and reliable service for retail and bulk customers.',
            'about_image' => 'assets/images/images-unsplash-com-photo-1571902943202-507ec2618e8f-5e2c843d0dbb.jpg',
            'about_image_alt' => 'B.BON training and fitness environment',
            'about_location_label' => 'Based In',
            'about_location_value' => 'Malad West, Mumbai',
            'about_cta_label' => 'Read Our Story',

            // Process / how it works
            'process_eyebrow' => 'How It Works',
            'process_title' => 'Four Steps. Zero Guesswork.',
            'process_subtitle' => 'A straightforward, transparent custom sportswear process - from first call to final delivery.',

            // CTA band
            'cta_title' => 'Ready to Create Custom Sportswear for Your Team or Brand?',
            'cta_subtitle' => 'Talk to our team and get a quote tailored to your fabric, quantity, design and printing requirements.',
        ];
    }
}
