@csrf

<div class="grid-2">
    <div class="field">
        <label for="title">Title</label>
        <input id="title" name="title" value="{{ old('title', $galleryItem->title) }}" required>
    </div>
    <div class="field">
        <label for="category">Category</label>
        <input id="category" name="category" value="{{ old('category', $galleryItem->category) }}" placeholder="Jerseys, T-Shirts, Team Orders">
    </div>
</div>

<div class="field">
    <label for="caption">Caption</label>
    <textarea id="caption" name="caption" maxlength="1000">{{ old('caption', $galleryItem->caption) }}</textarea>
</div>

<div class="grid-2">
    <div class="field">
        <label for="image_path">Existing Image Path</label>
        <input id="image_path" name="image_path" value="{{ old('image_path', $galleryItem->image_path) }}" placeholder="assets/images/example.jpg">
        @if ($galleryItem->image_path)
            <p class="muted">Current image:</p>
            <img class="thumb" src="{{ asset($galleryItem->image_path) }}" alt="{{ $galleryItem->alt_text ?: $galleryItem->title }}">
        @endif
    </div>
    <div class="field">
        <label for="image_file">Upload Image</label>
        <input id="image_file" type="file" name="image_file" accept="image/*">
        <p class="muted">JPG, PNG or WebP up to 6 MB. Uploading replaces the current image.</p>
    </div>
</div>

<div class="grid-2">
    <div class="field">
        <label for="alt_text">Image Alt Text</label>
        <input id="alt_text" name="alt_text" value="{{ old('alt_text', $galleryItem->alt_text) }}" placeholder="Defaults to the title">
    </div>
    <div class="field">
        <label for="sort_order">Sort Order</label>
        <input id="sort_order" type="number" min="0" name="sort_order" value="{{ old('sort_order', $galleryItem->sort_order ?? 0) }}">
    </div>
</div>

<div class="grid-3">
    <label class="check-row">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $galleryItem->exists ? $galleryItem->is_active : true))>
        Active
    </label>
    <label class="check-row">
        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $galleryItem->is_featured))>
        Featured Large Tile
    </label>
</div>

<div class="actions">
    <button class="btn btn-red" type="submit">{{ $submitLabel }}</button>
    <a class="btn" href="{{ route('admin.gallery-items.index') }}">Cancel</a>
</div>
