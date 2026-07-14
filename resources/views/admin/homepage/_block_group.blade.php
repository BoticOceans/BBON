@php
    $items = $blocks[$group];
    $showDescription = $showDescription ?? false;
@endphp
<div class="block-group" data-group="{{ $group }}">
    <div class="block-group-head">
        <label style="margin-bottom: 0;">{{ $label }}</label>
        <button type="button" class="btn" onclick="addBlockItem('{{ $group }}', {{ $showDescription ? 'true' : 'false' }})">Add {{ $singular ?? 'Item' }}</button>
    </div>
    <div id="block-container-{{ $group }}">
        @foreach ($items as $index => $item)
            @include('admin.homepage._block_item', ['group' => $group, 'item' => $item, 'index' => $index, 'showDescription' => $showDescription, 'placeholder' => $placeholder ?? null, 'descPlaceholder' => $descPlaceholder ?? null])
        @endforeach
    </div>
</div>

<template id="block-template-{{ $group }}">
    @include('admin.homepage._block_item', ['group' => $group, 'item' => new \App\Models\HomepageBlock(), 'index' => '__INDEX__', 'showDescription' => $showDescription, 'placeholder' => $placeholder ?? null, 'descPlaceholder' => $descPlaceholder ?? null])
</template>
