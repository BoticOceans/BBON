@extends('admin.layout')

@section('title', 'Add Product')

@section('content')
    <div class="page-head">
        <div>
            <h1>Add Product</h1>
            <p class="sub">Create a product for the B.BON catalogue.</p>
        </div>
        <a class="btn" href="{{ route('admin.products.index') }}">Back to Products</a>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @include('admin.products._form', ['submitLabel' => 'Save Product'])
    </form>
@endsection
