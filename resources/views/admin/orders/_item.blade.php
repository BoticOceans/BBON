<div class="order-item" data-item-index="{{ $index }}">
    <div class="order-item-head">
        <strong class="order-item-title">Item <span class="item-number">{{ is_numeric($index) ? $index + 1 : '' }}</span></strong>
        <button type="button" class="btn remove-item-btn" onclick="removeOrderItem(this)">Remove</button>
    </div>

    <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">

    <div class="grid-3">
        <div class="field">
            <label>Garment / Category</label>
            <select name="items[{{ $index }}][product_category_id]">
                <option value="">— None —</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((int) $item->product_category_id === $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>Row Label</label>
            <input type="text" name="items[{{ $index }}][label]" value="{{ $item->label }}" placeholder="e.g. Half Sleeve, Tracks">
        </div>
        <div class="field">
            <label>Order Type</label>
            <select name="items[{{ $index }}][order_type_id]">
                <option value="">— None —</option>
                @foreach ($orderTypes as $orderType)
                    <option value="{{ $orderType->id }}" @selected((int) $item->order_type_id === $orderType->id)>{{ $orderType->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid-3">
        <div class="field">
            <label>Collar</label>
            <select name="items[{{ $index }}][collar_id]">
                <option value="">— None —</option>
                @foreach ($collars as $collar)
                    <option value="{{ $collar->id }}" @selected((int) $item->collar_id === $collar->id)>{{ $collar->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>Fabric</label>
            <select name="items[{{ $index }}][fabric_id]">
                <option value="">— None —</option>
                @foreach ($fabrics as $fabric)
                    <option value="{{ $fabric->id }}" @selected((int) $item->fabric_id === $fabric->id)>{{ $fabric->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>Colour</label>
            <select name="items[{{ $index }}][colour_id]">
                <option value="">— None —</option>
                @foreach ($colours as $colour)
                    <option value="{{ $colour->id }}" @selected((int) $item->colour_id === $colour->id)>{{ $colour->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid-3">
        <div class="field">
            <label>Patch</label>
            <select name="items[{{ $index }}][patch_id]">
                <option value="">— None —</option>
                @foreach ($patches as $patch)
                    <option value="{{ $patch->id }}" @selected((int) $item->patch_id === $patch->id)>{{ $patch->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>Front</label>
            <input type="text" name="items[{{ $index }}][front]" value="{{ $item->front }}" placeholder="Front print detail">
        </div>
        <div class="field">
            <label>Back</label>
            <input type="text" name="items[{{ $index }}][back]" value="{{ $item->back }}" placeholder="Back print detail">
        </div>
    </div>

    <div class="field">
        <label>Sleeves</label>
        <input type="text" name="items[{{ $index }}][sleeves]" value="{{ $item->sleeves }}" placeholder="Sleeve print detail">
    </div>

    <div class="field" style="margin-bottom: 8px;">
        <label>Size Quantities</label>
        <div class="size-grid">
            @foreach ($sizes as $size)
                @php $qty = $item->sizes[$size->id] ?? ($item->sizes[(string) $size->id] ?? ''); @endphp
                <div class="size-cell">
                    <span class="size-cell-label">{{ $size->name }}</span>
                    <input type="number" min="0" class="size-qty-input" name="items[{{ $index }}][sizes][{{ $size->id }}]" value="{{ $qty !== '' ? $qty : '' }}" oninput="updateItemTotal(this)">
                </div>
            @endforeach
        </div>
        <p class="muted item-total-line">Item Total: <strong class="item-total">{{ $item->exists ? $item->totalQuantity() : 0 }}</strong></p>
    </div>
</div>
