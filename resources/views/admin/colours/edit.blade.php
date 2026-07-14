@extends('admin.layout')

@section('title', 'Edit Colour')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Colour</h1>
            <p class="sub">{{ $item->name }}</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.colours.update', $item) }}">
        @method('PUT')
        @include('admin.colours._form', ['submitLabel' => 'Update Colour'])
    </form>
@endsection
