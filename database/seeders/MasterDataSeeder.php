<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDataSeeder extends Seeder
{
    /**
     * Seed the order-specification master lists (fabrics, colours, collars,
     * patches, order types, sizes) sourced from the client's order format sheet.
     */
    public function run(): void
    {
        $this->seedList('order_types', [
            'Pattern',
            'Front Digital',
            'Front Back Digital',
            'Full Digital',
            'Wrangler Pattern',
            'Wrangler Front Digital',
            'Wrangler Front Back Digital',
            'Wrangler Full Digital',
        ]);
        $this->seedList('collars', [
            'Ready Collar',
            'Fabric Collar',
            'Chinese Collar',
        ]);
        $this->seedList('fabrics', [
            'Dryfit',
            'Advance',
            'Mass',
            'Combo',
            'Jaquard',
            'Monostrip 1',
            'Monostrip 2',
            'Leather Finish',
            'Dcode',
            '4Way',
            'Milang',
            'NS',
            'Superpoly',
        ]);
        $this->seedList('colours', [
            'White',
            'Black',
            'Navy Blue',
            'Offwhite',
            'C. Green',
            'P. Blue',
            'Firoji',
            'Sky Blue',
            'Royal Blue',
            'Lemon',
            'Gold',
            'Baby Pink',
            'D. Pink',
            'Neon Green',
            'Neon Orange',
            'Neon Pink',
            'D. Grey',
            'L. Grey',
            'Red',
            'Maroon',
            'Purple',
            'Hawai',
            'B. Green',
            'Orange',
        ]);
        $this->seedList('patches', [
            'Digital',
            'Fabric',
        ]);
        $this->seedList('sizes', [
            '20',
            '22',
            '24',
            '26',
            '28',
            '30',
            '32',
            '34/XS',
            '36/S',
            '38/M',
            '40/L',
            '42/XL',
            '44/2XL',
            '46/3XL',
            '48/4XL',
            '50',
        ]);
    }

    /**
     * @param  array<int, string>  $names
     */
    private function seedList(string $table, array $names): void
    {
        foreach ($names as $index => $name) {
            DB::table($table)->updateOrInsert(
                ['name' => $name],
                [
                    'sort_order' => $index,
                    'is_active' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
