@extends('admin.layout')

@section('title', 'Add Collar')

@section('content')
    <div class="page-head">
        <div>
            <h1>Add Collar</h1>
            <p class="sub">Create a new collar option.</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.collars.store') }}">
        @include('admin.collars._form', ['submitLabel' => 'Save Collar'])
    </form>
@endsection
