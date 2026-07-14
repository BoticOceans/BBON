@csrf

<div class="grid-2">
    <div class="field">
        <label for="name">Fabric Name</label>
        <input id="name" name="name" value="{{ old('name', $item->name) }}" required autofocus>
    </div>
    <div class="field">
        <label for="sort_order">Sort Order</label>
        <input id="sort_order" type="number" min="0" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
    </div>
</div>

<label class="check-row">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->exists ? $item->is_active : true))>
    Active
</label>

<div class="actions">
    <button class="btn btn-red" type="submit">{{ $submitLabel }}</button>
    <a class="btn" href="{{ route('admin.fabrics.index') }}">Cancel</a>
</div>
