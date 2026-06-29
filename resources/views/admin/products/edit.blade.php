@extends('admin.layout')

@section('title', 'Edit Product')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Product</h1>
            <p class="sub">Update product details, image and visibility.</p>
        </div>
        <a class="btn" href="{{ route('admin.products.index') }}">Back to Products</a>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.products._form', ['submitLabel' => 'Update Product'])
    </form>
@endsection
