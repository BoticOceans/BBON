@csrf

<div class="grid-2">
    <div class="field">
        <label for="name">Category Name</label>
        <input id="name" name="name" value="{{ old('name', $category->name) }}" required>
    </div>
    <div class="field">
        <label for="slug">Slug</label>
        <input id="slug" name="slug" value="{{ old('slug', $category->slug) }}" placeholder="auto-created if empty">
    </div>
</div>

<div class="field">
    <label for="description">Description</label>
    <textarea id="description" name="description">{{ old('description', $category->description) }}</textarea>
</div>

<div class="grid-2">
    <div class="field">
        <label for="sort_order">Sort Order</label>
        <input id="sort_order" type="number" min="0" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
    </div>
    <label class="check-row">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->exists ? $category->is_active : true))>
        Active
    </label>
</div>

<div class="actions">
    <button class="btn btn-red" type="submit">{{ $submitLabel }}</button>
    <a class="btn" href="{{ route('admin.product-categories.index') }}">Cancel</a>
</div>
