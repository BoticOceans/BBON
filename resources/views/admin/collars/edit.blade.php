@extends('admin.layout')

@section('title', 'Edit Collar')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Collar</h1>
            <p class="sub">{{ $item->name }}</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.collars.update', $item) }}">
        @method('PUT')
        @include('admin.collars._form', ['submitLabel' => 'Update Collar'])
    </form>
@endsection
