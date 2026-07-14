@extends('admin.layout')

@section('title', 'Add Order Type')

@section('content')
    <div class="page-head">
        <div>
            <h1>Add Order Type</h1>
            <p class="sub">Create a new order type option.</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.order-types.store') }}">
        @include('admin.order-types._form', ['submitLabel' => 'Save Order Type'])
    </form>
@endsection
