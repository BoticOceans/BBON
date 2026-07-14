@extends('admin.layout')

@section('title', 'Edit Order')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Order</h1>
            <p class="sub">{{ $order->order_no }}</p>
        </div>
        <a class="btn" href="{{ route('admin.orders.index') }}">Back to Orders</a>
    </div>

    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
        @method('PUT')
        @include('admin.orders._form', ['submitLabel' => 'Update Order'])
    </form>
@endsection
