@extends('admin.layout')

@section('title', 'Products')

@section('content')
    <div class="page-head">
        <div>
            <h1>Products</h1>
            <p class="sub">Manage catalogue products, images and customisation details.</p>
        </div>
        <a class="btn btn-red" href="{{ route('admin.products.create') }}">Add Product</a>
    </div>

    <section class="panel table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            @if ($product->image_path)
                                <img class="thumb" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <div class="thumb"></div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $product->name }}</strong>
                            <div class="muted">{{ $product->short_description }}</div>
                        </td>
                        <td>{{ $product->category?->name }}</td>
                        <td>{{ $product->sort_order }}</td>
                        <td>
                            <span class="badge {{ $product->is_active ? 'badge-on' : 'badge-off' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            @if ($product->is_featured)
                                <span class="badge">Featured</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="muted">No products yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <div class="pagination">{{ $products->links() }}</div>
@endsection
