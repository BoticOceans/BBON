@extends('admin.layout')

@section('title', 'Add Size')

@section('content')
    <div class="page-head">
        <div>
            <h1>Add Size</h1>
            <p class="sub">Create a new size option.</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.sizes.store') }}">
        @include('admin.sizes._form', ['submitLabel' => 'Save Size'])
    </form>
@endsection
