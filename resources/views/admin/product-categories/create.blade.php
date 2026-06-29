@extends('admin.layout')

@section('title', 'Add Category')

@section('content')
    <div class="page-head">
        <div>
            <h1>Add Category</h1>
            <p class="sub">Create a new product grouping.</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.product-categories.store') }}">
        @include('admin.product-categories._form', ['submitLabel' => 'Save Category'])
    </form>
@endsection
