@extends('admin.layout')

@section('title', 'Edit Patch')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Patch</h1>
            <p class="sub">{{ $item->name }}</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.patches.update', $item) }}">
        @method('PUT')
        @include('admin.patches._form', ['submitLabel' => 'Update Patch'])
    </form>
@endsection
