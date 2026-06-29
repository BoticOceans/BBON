@csrf

@php
    $bestFor = old('best_for', implode(', ', $product->best_for ?? []));
    $customisations = old('customisations', implode(', ', $product->customisations ?? []));
@endphp

@if ($categories->isEmpty())
    <div class="alert alert-error">
        Add at least one product category before creating products.
    </div>
@endif

<div class="grid-2">
    <div class="field">
        <label for="product_category_id">Category</label>
        <select id="product_category_id" name="product_category_id" required>
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('product_category_id', $product->product_category_id) === $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label for="sort_order">Sort Order</label>
        <input id="sort_order" type="number" min="0" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}">
    </div>
</div>

<div class="grid-2">
    <div class="field">
        <label for="name">Product Name</label>
        <input id="name" name="name" value="{{ old('name', $product->name) }}" required>
    </div>
    <div class="field">
        <label for="slug">Slug</label>
        <input id="slug" name="slug" value="{{ old('slug', $product->slug) }}" placeholder="auto-created if empty">
    </div>
</div>

<div class="field">
    <label for="short_description">Short Description</label>
    <textarea id="short_description" name="short_description" maxlength="500">{{ old('short_description', $product->short_description) }}</textarea>
</div>

<div class="field">
    <label for="description">Full Description</label>
    <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
</div>

<div class="grid-2">
    <div class="field">
        <label for="image_path">Existing Image Path</label>
        <input id="image_path" name="image_path" value="{{ old('image_path', $product->image_path) }}" placeholder="assets/images/example.jpg">
        @if ($product->image_path)
            <p class="muted">Current image:</p>
            <img class="thumb" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
        @endif
    </div>
    <div class="field">
        <label for="image_file">Upload Image</label>
        <input id="image_file" type="file" name="image_file" accept="image/*">
        <p class="muted">Uploading a file replaces the image path above.</p>
    </div>
</div>

<div class="grid-2">
    <div class="field">
        <label for="fabric">Fabric</label>
        <input id="fabric" name="fabric" value="{{ old('fabric', $product->fabric) }}">
    </div>
    <div class="field">
        <label for="sizes">Sizes</label>
        <input id="sizes" name="sizes" value="{{ old('sizes', $product->sizes) }}">
    </div>
</div>

<div class="grid-2">
    <div class="field">
        <label for="best_for">Best For</label>
        <textarea id="best_for" name="best_for" placeholder="Events, Retail, Team wear">{{ $bestFor }}</textarea>
        <p class="muted">Use commas or new lines.</p>
    </div>
    <div class="field">
        <label for="customisations">Customisations</label>
        <textarea id="customisations" name="customisations" placeholder="Logo print, Embroidery">{{ $customisations }}</textarea>
        <p class="muted">Use commas or new lines.</p>
    </div>
</div>

<div class="grid-3">
    <label class="check-row">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->exists ? $product->is_active : true))>
        Active
    </label>
    <label class="check-row">
        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))>
        Featured
    </label>
</div>

<div class="actions">
    <button class="btn btn-red" type="submit" @disabled($categories->isEmpty())>{{ $submitLabel }}</button>
    <a class="btn" href="{{ route('admin.products.index') }}">Cancel</a>
</div>
