@extends('admin.layout')

@section('title', 'Add Order')

@section('content')
    <div class="page-head">
        <div>
            <h1>Add Order</h1>
            <p class="sub">Create a new order with garment specifications and size quantities.</p>
        </div>
        <a class="btn" href="{{ route('admin.orders.index') }}">Back to Orders</a>
    </div>

    <form method="POST" action="{{ route('admin.orders.store') }}">
        @include('admin.orders._form', ['submitLabel' => 'Save Order'])
    </form>
@endsection
