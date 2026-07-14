@extends('admin.layout')

@section('title', 'Fabrics')

@section('content')
    <div class="page-head">
        <div>
            <h1>Fabrics</h1>
            <p class="sub">Manage the fabric options used across orders.</p>
        </div>
        <a class="btn btn-red" href="{{ route('admin.fabrics.create') }}">Add Fabric</a>
    </div>

    <section class="panel table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td>{{ $item->sort_order }}</td>
                        <td>
                            <span class="badge {{ $item->is_active ? 'badge-on' : 'badge-off' }}">
                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn" href="{{ route('admin.fabrics.edit', $item) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.fabrics.destroy', $item) }}" onsubmit="return confirm('Delete this fabric?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="muted">No fabrics yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <div class="pagination">{{ $items->links() }}</div>
@endsection
