@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="page-head">
        <div>
            <h1>Dashboard</h1>
            <p class="sub">Manage B.BON product catalogue content.</p>
        </div>
        <div class="actions">
            <a class="btn" href="{{ route('admin.product-categories.create') }}">Add Category</a>
            <a class="btn btn-red" href="{{ route('admin.products.create') }}">Add Product</a>
        </div>
    </div>

    <div class="stats">
        <div class="stat">
            <strong>{{ $categoryCount }}</strong>
            <span>Categories</span>
        </div>
        <div class="stat">
            <strong>{{ $productCount }}</strong>
            <span>Total Products</span>
        </div>
        <div class="stat">
            <strong>{{ $activeProductCount }}</strong>
            <span>Active Products</span>
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
