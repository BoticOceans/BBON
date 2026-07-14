@extends('admin.layout')

@section('title', 'Add Patch')

@section('content')
    <div class="page-head">
        <div>
            <h1>Add Patch</h1>
            <p class="sub">Create a new patch option.</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.patches.store') }}">
        @include('admin.patches._form', ['submitLabel' => 'Save Patch'])
    </form>
@endsection
