@extends('admin.layout')

@section('title', 'Gallery')

@section('content')
    <div class="page-head">
        <div>
            <h1>Gallery</h1>
            <p class="sub">Manage the work and product images shown on the public gallery page.</p>
        </div>
        <a class="btn btn-red" href="{{ route('admin.gallery-items.create') }}">Add Gallery Item</a>
    </div>

    <section class="panel table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galleryItems as $galleryItem)
                    <tr>
                        <td><img class="thumb" src="{{ asset($galleryItem->image_path) }}" alt="{{ $galleryItem->alt_text }}"></td>
                        <td>
                            <strong>{{ $galleryItem->title }}</strong>
                            @if ($galleryItem->caption)
                                <div class="muted">{{ $galleryItem->caption }}</div>
                            @endif
                        </td>
                        <td>{{ $galleryItem->category ?: 'Uncategorised' }}</td>
                        <td>{{ $galleryItem->sort_order }}</td>
                        <td>
                            <span class="badge {{ $galleryItem->is_active ? 'badge-on' : 'badge-off' }}">
                                {{ $galleryItem->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            @if ($galleryItem->is_featured)
                                <span class="badge">Featured</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn" href="{{ route('admin.gallery-items.edit', $galleryItem) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.gallery-items.destroy', $galleryItem) }}" onsubmit="return confirm('Delete this gallery item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="muted">No gallery items yet. Add one to publish it on the site.</td></tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <div class="pagination">{{ $galleryItems->links() }}</div>
@endsection
