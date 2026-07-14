@extends('admin.layout')

@section('title', 'Add Colour')

@section('content')
    <div class="page-head">
        <div>
            <h1>Add Colour</h1>
            <p class="sub">Create a new colour option.</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.colours.store') }}">
        @include('admin.colours._form', ['submitLabel' => 'Save Colour'])
    </form>
@endsection
