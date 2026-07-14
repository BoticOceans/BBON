@extends('admin.layout')

@section('title', 'Add Gallery Item')

@section('content')
    <div class="page-head">
        <div>
            <h1>Add Gallery Item</h1>
            <p class="sub">Publish a new image on the public gallery page.</p>
        </div>
        <a class="btn" href="{{ route('admin.gallery-items.index') }}">Back to Gallery</a>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.gallery-items.store') }}" enctype="multipart/form-data">
        @include('admin.gallery-items._form', ['submitLabel' => 'Save Gallery Item'])
    </form>
@endsection
