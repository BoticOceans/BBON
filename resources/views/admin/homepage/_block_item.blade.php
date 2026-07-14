<div class="block-item" data-block-index="{{ $index }}">
    <input type="hidden" name="blocks[{{ $group }}][{{ $index }}][id]" value="{{ $item->id }}">
    <div class="block-item-row">
        <div class="field" style="margin-bottom: 0; flex: 1;">
            <label>{{ $showDescription ? 'Title' : 'Text' }}</label>
            <input type="text" name="blocks[{{ $group }}][{{ $index }}][title]" value="{{ $item->title }}" placeholder="{{ $placeholder ?? '' }}">
        </div>
        <button type="button" class="btn remove-item-btn block-item-remove" onclick="removeBlockItem(this)">Remove</button>
    </div>
    @if ($showDescription)
        <div class="field" style="margin: 12px 0 0;">
            <label>Description</label>
            <input type="text" name="blocks[{{ $group }}][{{ $index }}][description]" value="{{ $item->description }}" placeholder="{{ $descPlaceholder ?? '' }}">
        </div>
    @endif
</div>
