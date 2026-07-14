@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="page-head">
        <div>
            <h1>Dashboard</h1>
            <p class="sub">Manage the B.BON product catalogue and public gallery.</p>
        </div>
        <div class="actions">
            <a class="btn" href="{{ route('admin.product-categories.create') }}">Add Category</a>
            <a class="btn" href="{{ route('admin.products.create') }}">Add Product</a>
            <a class="btn" href="{{ route('admin.gallery-items.create') }}">Add Gallery Item</a>
            <a class="btn btn-red" href="{{ route('admin.orders.create') }}">Add Order</a>
        </div>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="stat-top">
                <span class="stat-icon icon-purple">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1"></rect></svg>
                </span>
            </div>
            <strong>{{ $orderCount }}</strong>
            <span class="label">Total Orders</span>
        </div>
        <div class="stat">
            <div class="stat-top">
                <span class="stat-icon icon-orange">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </span>
            </div>
            <strong>{{ $pendingOrderCount }}</strong>
            <span class="label">Pending Orders</span>
        </div>
        <div class="stat">
            <div class="stat-top">
                <span class="stat-icon icon-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path><path d="M12 8v4l3 3"></path></svg>
                </span>
            </div>
            <strong>{{ $inProductionOrderCount }}</strong>
            <span class="label">In Production</span>
        </div>
        <div class="stat">
            <div class="stat-top">
                <span class="stat-icon icon-green">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                </span>
            </div>
            <strong>{{ $dispatchedOrderCount }}</strong>
            <span class="label">Dispatched / Delivered</span>
        </div>
    </div>

    <section class="panel" style="margin-bottom: 24px;">
        <div class="panel-pad" style="display: flex; align-items: center; justify-content: space-between;">
            <h2 style="margin: 0;">Recent Orders</h2>
            <a class="btn" href="{{ route('admin.orders.index') }}">View All</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Customer</th>
                        <th>Delivery</th>
                        <th>Items</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td><strong>{{ $order->order_no }}</strong></td>
                            <td>{{ $order->customer_name ?: '—' }}</td>
                            <td class="muted">{{ $order->delivery_date?->format('d M Y') ?: '—' }}</td>
                            <td>{{ $order->items_count }}</td>
                            <td>{{ $order->totalQuantity() }}</td>
                            <td>
                                <span class="badge badge-status-{{ $order->status }}">{{ $order->statusLabel() }}</span>
                            </td>
                            <td><a class="btn" href="{{ route('admin.orders.edit', $order) }}">Edit</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="muted">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="stats">
        <div class="stat">
            <div class="stat-top">
                <span class="stat-icon icon-purple">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"></path></svg>
                </span>
            </div>
            <strong>{{ $categoryCount }}</strong>
            <span class="label">Categories</span>
        </div>
        <div class="stat">
            <div class="stat-top">
                <span class="stat-icon icon-orange">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 .55.45 1 1 1h10a1 1 0 0 0 1-1V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"></path></svg>
                </span>
            </div>
            <strong>{{ $productCount }}</strong>
            <span class="label">Total Products</span>
        </div>
        <div class="stat">
            <div class="stat-top">
                <span class="stat-icon icon-green">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </span>
            </div>
            <strong>{{ $activeProductCount }}</strong>
            <span class="label">Active Products</span>
        </div>
        <div class="stat">
            <div class="stat-top">
                <span class="stat-icon icon-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"></path></svg>
                </span>
            </div>
            <strong>{{ $galleryItemCount }}</strong>
            <span class="label">Gallery Items</span>
        </div>
    </div>

    <section class="panel">
        <div class="panel-pad">
            <h2 style="margin: 0;">Latest Products</h2>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestProducts as $product)
                        <tr>
                            <td><strong>{{ $product->name }}</strong></td>
                            <td>{{ $product->category?->name }}</td>
                            <td>
                                <span class="badge {{ $product->is_active ? 'badge-on' : 'badge-off' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="muted">{{ $product->updated_at?->format('d M Y') }}</td>
                            <td><a class="btn" href="{{ route('admin.products.edit', $product) }}">Edit</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="muted">No products yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
