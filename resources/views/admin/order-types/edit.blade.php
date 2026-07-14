@extends('admin.layout')

@section('title', 'Edit Order Type')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Order Type</h1>
            <p class="sub">{{ $item->name }}</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.order-types.update', $item) }}">
        @method('PUT')
        @include('admin.order-types._form', ['submitLabel' => 'Update Order Type'])
    </form>
@endsection
