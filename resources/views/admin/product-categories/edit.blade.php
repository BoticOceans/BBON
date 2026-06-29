@extends('admin.layout')

@section('title', 'Edit Category')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Category</h1>
            <p class="sub">{{ $category->name }}</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.product-categories.update', $category) }}">
        @method('PUT')
        @include('admin.product-categories._form', ['submitLabel' => 'Update Category'])
    </form>
@endsection
