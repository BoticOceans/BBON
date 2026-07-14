@extends('admin.layout')

@section('title', 'Edit Fabric')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Fabric</h1>
            <p class="sub">{{ $item->name }}</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.fabrics.update', $item) }}">
        @method('PUT')
        @include('admin.fabrics._form', ['submitLabel' => 'Update Fabric'])
    </form>
@endsection
