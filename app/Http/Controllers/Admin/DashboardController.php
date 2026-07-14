<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'categoryCount' => ProductCategory::count(),
            'productCount' => Product::count(),
            'activeProductCount' => Product::where('is_active', true)->count(),
            'galleryItemCount' => GalleryItem::count(),
            'latestProducts' => Product::with('category')->latest()->take(5)->get(),
            'orderCount' => Order::count(),
            'pendingOrderCount' => Order::where('status', 'pending')->count(),
            'inProductionOrderCount' => Order::where('status', 'in_production')->count(),
            'dispatchedOrderCount' => Order::whereIn('status', ['dispatched', 'delivered'])->count(),
            'recentOrders' => Order::withCount('items')->with('items')->latest('order_date')->take(5)->get(),
        ]);
    }
}
