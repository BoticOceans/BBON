<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\View\View;

class PublicCatalogController extends Controller
{
    public function products(): View
    {
        $categories = ProductCategory::query()
            ->where('is_active', true)
            ->whereHas('products', fn ($query) => $query->where('is_active', true))
            ->with(['products' => fn ($query) => $query
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('pages.products', [
            'productCategories' => $categories,
            'products' => $categories->flatMap->products,
        ]);
    }

    public function customSportswear(): View
    {
        $products = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('pages.custom-sportswear', [
            'pickProducts' => $products,
        ]);
    }

    public function gallery(): View
    {
        $galleryItems = GalleryItem::query()
            ->where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('pages.gallery', [
            'galleryItems' => $galleryItems,
            'galleryCategories' => $galleryItems->pluck('category')->filter()->unique()->values(),
        ]);
    }
}
