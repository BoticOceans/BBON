@extends('admin.layout')

@section('title', 'Add Fabric')

@section('content')
    <div class="page-head">
        <div>
            <h1>Add Fabric</h1>
            <p class="sub">Create a new fabric option.</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.fabrics.store') }}">
        @include('admin.fabrics._form', ['submitLabel' => 'Save Fabric'])
    </form>
@endsection
