@extends('admin.layout')

@section('title', 'Edit Size')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Size</h1>
            <p class="sub">{{ $item->name }}</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.sizes.update', $item) }}">
        @method('PUT')
        @include('admin.sizes._form', ['submitLabel' => 'Update Size'])
    </form>
@endsection
