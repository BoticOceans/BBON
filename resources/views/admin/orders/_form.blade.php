@csrf

<div class="panel panel-pad" style="margin-bottom: 18px;">
    <div class="grid-3">
        <div class="field">
            <label for="order_no">Order No</label>
            <input id="order_no" name="order_no" value="{{ old('order_no', $order->order_no) }}" required>
        </div>
        <div class="field">
            <label for="customer_name">Customer</label>
            <input id="customer_name" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" placeholder="Optional">
        </div>
        <div class="field">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $order->status) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid-3">
        <div class="field">
            <label for="order_date">Order Date</label>
            <input id="order_date" type="date" name="order_date" value="{{ old('order_date', optional($order->order_date)->format('Y-m-d')) }}" required>
        </div>
        <div class="field">
            <label for="delivery_date">Delivery Date</label>
            <input id="delivery_date" type="date" name="delivery_date" value="{{ old('delivery_date', optional($order->delivery_date)->format('Y-m-d')) }}">
        </div>
    </div>

    <div class="field" style="margin-bottom: 0;">
        <label for="notes">Notes</label>
        <textarea id="notes" name="notes">{{ old('notes', $order->notes) }}</textarea>
    </div>
</div>

<div class="page-head" style="margin-bottom: 14px;">
    <div>
        <h2 style="margin: 0; font-size: 18px;">Order Items</h2>
        <p class="sub" style="margin-top: 4px;">Add one row per garment line (e.g. T-Shirts – Half Sleeve, Tracks).</p>
    </div>
    <button type="button" class="btn btn-red" onclick="addOrderItem()">Add Item</button>
</div>

<div id="items-container">
    @foreach ($items as $index => $item)
        <div class="panel panel-pad order-item-wrap">
            @include('admin.orders._item', ['item' => $item, 'index' => $index])
        </div>
    @endforeach
</div>

<template id="item-template">
    <div class="panel panel-pad order-item-wrap">
        @include('admin.orders._item', ['item' => new \App\Models\OrderItem(), 'index' => '__INDEX__'])
    </div>
</template>

<div class="actions" style="margin-top: 18px;">
    <button class="btn btn-red" type="submit">{{ $submitLabel }}</button>
    <a class="btn" href="{{ route('admin.orders.index') }}">Cancel</a>
</div>

<script>
    (function () {
        window.__orderItemSeq = {{ max(count($items), 1) }};
    })();

    function addOrderItem() {
        var template = document.getElementById('item-template');
        var container = document.getElementById('items-container');
        var index = window.__orderItemSeq++;
        var html = template.innerHTML.replaceAll('__INDEX__', index);
        var wrapper = document.createElement('div');
        wrapper.innerHTML = html.trim();
        container.appendChild(wrapper.firstElementChild);
        renumberOrderItems();
    }

    function removeOrderItem(button) {
        var wrap = button.closest('.order-item-wrap');
        var container = document.getElementById('items-container');
        if (container.querySelectorAll('.order-item-wrap').length <= 1) {
            wrap.querySelectorAll('input[type=text], input[type=number], textarea').forEach(function (el) { el.value = ''; });
            wrap.querySelectorAll('select').forEach(function (el) { el.selectedIndex = 0; });
            return;
        }
        wrap.remove();
        renumberOrderItems();
    }

    function renumberOrderItems() {
        document.querySelectorAll('.order-item-wrap .order-item').forEach(function (item, i) {
            var numberEl = item.querySelector('.item-number');
            if (numberEl) {
                numberEl.textContent = i + 1;
            }
        });
    }

    function updateItemTotal(input) {
        var item = input.closest('.order-item');
        var total = 0;
        item.querySelectorAll('.size-qty-input').forEach(function (el) {
            var v = parseInt(el.value, 10);
            if (!isNaN(v)) {
                total += v;
            }
        });
        var totalEl = item.querySelector('.item-total');
        if (totalEl) {
            totalEl.textContent = total;
        }
    }

    renumberOrderItems();
</script>
