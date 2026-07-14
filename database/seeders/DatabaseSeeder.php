<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProductCatalogSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(MasterDataSeeder::class);
        $this->call(HomepageContentSeeder::class);
        $this->call(HomepageBlockSeeder::class);
    }
}
