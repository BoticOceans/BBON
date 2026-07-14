<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\HomepageBlock;
use App\Models\HomepageContent;
use App\Models\Product;
use Illuminate\View\View;

class PublicHomeController extends Controller
{
    public function __invoke(): View
    {
        $blocks = [];
        foreach (array_keys(HomepageBlock::GROUPS) as $group) {
            $blocks[$group] = HomepageBlock::query()->ofGroup($group)->active()->ordered()->get();
        }

        return view('pages.index-light', [
            'content' => HomepageContent::map(),
            'marqueeItems' => $blocks['marquee'],
            'techniques' => $blocks['techniques'],
            'services' => $blocks['services'],
            'features' => $blocks['features'],
            'processSteps' => $blocks['process_steps'],
            'featuredProducts' => Product::with('category')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->take(8)
                ->get(),
            'featuredGalleryItems' => GalleryItem::where('is_active', true)
                ->orderByDesc('is_featured')
                ->orderBy('sort_order')
                ->take(8)
                ->get(),
        ]);
    }
}
