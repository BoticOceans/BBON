@extends('admin.layout')

@section('title', 'Edit Gallery Item')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Gallery Item</h1>
            <p class="sub">Update the image, caption, order and public visibility.</p>
        </div>
        <a class="btn" href="{{ route('admin.gallery-items.index') }}">Back to Gallery</a>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.gallery-items.update', $galleryItem) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.gallery-items._form', ['submitLabel' => 'Update Gallery Item'])
    </form>
@endsection
