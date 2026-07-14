<?php

namespace Tests\Feature;

use App\Models\GalleryItem;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_gallery_requires_authentication(): void
    {
        $this->get('/admin/gallery-items')
            ->assertRedirect('/admin/login');
    }

    public function test_authenticated_admin_can_create_a_gallery_item(): void
    {
        $response = $this->withSession(['admin_authenticated' => true])
            ->post('/admin/gallery-items', [
                'title' => 'Corporate Cricket Kit',
                'category' => 'Jerseys',
                'caption' => 'A completed bulk team order.',
                'image_path' => 'assets/images/test-kit.jpg',
                'sort_order' => 4,
                'is_active' => '1',
                'is_featured' => '1',
            ]);

        $response->assertRedirect('/admin/gallery-items');
        $this->assertDatabaseHas('gallery_items', [
            'title' => 'Corporate Cricket Kit',
            'alt_text' => 'Corporate Cricket Kit',
            'is_active' => true,
            'is_featured' => true,
        ]);
    }

    public function test_public_gallery_only_shows_active_cms_items(): void
    {
        GalleryItem::create([
            'title' => 'Visible Team Order',
            'category' => 'Team Orders',
            'image_path' => 'assets/images/visible.jpg',
            'is_active' => true,
        ]);
        GalleryItem::create([
            'title' => 'Hidden Team Order',
            'category' => 'Team Orders',
            'image_path' => 'assets/images/hidden.jpg',
            'is_active' => false,
        ]);

        $this->get('/gallery')
            ->assertOk()
            ->assertSee('Visible Team Order')
            ->assertDontSee('Hidden Team Order');
    }

    public function test_public_products_page_uses_active_catalogue_records(): void
    {
        $category = ProductCategory::create([
            'name' => 'Team Kits',
            'slug' => 'team-kits',
            'is_active' => true,
        ]);

        Product::create([
            'product_category_id' => $category->id,
            'name' => 'CMS Managed Kit',
            'slug' => 'cms-managed-kit',
            'short_description' => 'Added by the admin CMS.',
            'is_active' => true,
        ]);
        Product::create([
            'product_category_id' => $category->id,
            'name' => 'Inactive CMS Kit',
            'slug' => 'inactive-cms-kit',
            'is_active' => false,
        ]);

        $this->get('/products')
            ->assertOk()
            ->assertSee('CMS Managed Kit')
            ->assertDontSee('Inactive CMS Kit');
    }
}
