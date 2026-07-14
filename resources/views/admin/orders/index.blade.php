@extends('admin.layout')

@section('title', 'Orders')

@section('content')
    <div class="page-head">
        <div>
            <h1>Orders</h1>
            <p class="sub">Track and manage custom sportswear orders.</p>
        </div>
        <a class="btn btn-red" href="{{ route('admin.orders.create') }}">Add Order</a>
    </div>

    <div class="panel panel-pad" style="margin-bottom: 18px;">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="grid-3" style="align-items: end;">
            <div class="field" style="margin-bottom: 0;">
                <label for="status">Filter by Status</label>
                <select id="status" name="status" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}" @selected($activeStatus === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            @if ($activeStatus !== '')
                <div class="field" style="margin-bottom: 0;">
                    <a class="btn" href="{{ route('admin.orders.index') }}">Clear Filter</a>
                </div>
            @endif
        </form>
    </div>

    <section class="panel table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Order No</th>
                    <th>Customer</th>
                    <th>Order Date</th>
                    <th>Delivery</th>
                    <th>Items</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td><strong>{{ $order->order_no }}</strong></td>
                        <td>{{ $order->customer_name ?: '—' }}</td>
                        <td class="muted">{{ $order->order_date?->format('d M Y') }}</td>
                        <td class="muted">{{ $order->delivery_date?->format('d M Y') ?: '—' }}</td>
                        <td>{{ $order->items_count }}</td>
                        <td>{{ $order->totalQuantity() }}</td>
                        <td>
                            <span class="badge badge-status-{{ $order->status }}">{{ $order->statusLabel() }}</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn" href="{{ route('admin.orders.edit', $order) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" onsubmit="return confirm('Delete this order?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="muted">No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <div class="pagination">{{ $orders->links() }}</div>
@endsection
