<template id="cms-products-filter-template">
    <section class="border-b border-[#262626] bg-[#0a0a0a] sticky top-20 z-30 backdrop-blur-xl" data-cms-products-filters>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 overflow-x-auto">
            <div class="flex gap-2 min-w-max">
                <button type="button" data-cms-product-filter="all" class="px-4 py-2.5 text-xs font-semibold uppercase tracking-widest transition-colors border bg-[#ff1e1e] text-white border-[#ff1e1e]">All</button>
                @foreach ($productCategories as $category)
                    <button type="button" data-cms-product-filter="{{ $category->slug }}" class="px-4 py-2.5 text-xs font-semibold uppercase tracking-widest transition-colors border border-[#262626] text-neutral-300 hover:border-white hover:text-white">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>
</template>

<template id="cms-products-grid-template">
    <section class="py-16 sm:py-20" data-cms-products-grid>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($products->isEmpty())
                <div class="border border-[#d5dde8] bg-white p-10 text-center">
                    <h3 class="font-display text-2xl font-black uppercase text-[#111827]">Products Coming Soon</h3>
                    <p class="mt-3 text-[#526178]">Our catalogue is being updated. Contact us for current products and bulk pricing.</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach ($products as $product)
                        <article id="{{ $product->slug }}" data-cms-product-card data-category="{{ $product->category->slug }}" class="group border border-[#d5dde8] bg-white overflow-hidden scroll-mt-44" style="box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);">
                            <div class="grid sm:grid-cols-[0.95fr_1.05fr] items-center">
                                <div class="relative aspect-[4/5] overflow-hidden bg-[#f5f7fa]">
                                    @if ($product->image_path)
                                        <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                    @endif
                                    @if ($product->is_featured)
                                        <span class="absolute top-4 left-4 bg-[#ff1e1e] text-white px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest">Featured</span>
                                    @endif
                                </div>
                                <div class="p-6 sm:p-8 flex flex-col">
                                    <p class="text-[#ff1e1e] text-xs font-bold uppercase tracking-[0.2em]">{{ $product->category->name }}</p>
                                    <h3 class="font-display mt-3 text-2xl sm:text-3xl font-black uppercase tracking-tight text-[#111827]">{{ $product->name }}</h3>
                                    @if ($product->short_description)
                                        <p class="mt-4 text-[#526178] leading-relaxed">{{ $product->short_description }}</p>
                                    @endif
                                    @if ($product->fabric || $product->sizes)
                                        <dl class="mt-6 space-y-3 text-sm border-t border-[#dbe3ed] pt-5">
                                            @if ($product->fabric)
                                                <div><dt class="text-[#7a8798] uppercase tracking-widest text-[10px] font-bold">Fabric</dt><dd class="mt-1 text-[#263244]">{{ $product->fabric }}</dd></div>
                                            @endif
                                            @if ($product->sizes)
                                                <div><dt class="text-[#7a8798] uppercase tracking-widest text-[10px] font-bold">Sizes</dt><dd class="mt-1 text-[#263244]">{{ $product->sizes }}</dd></div>
                                            @endif
                                        </dl>
                                    @endif
                                    @if (! empty($product->customisations))
                                        <div class="mt-5 flex flex-wrap gap-2">
                                            @foreach ($product->customisations as $customisation)
                                                <span class="border border-[#d5dde8] bg-white px-2.5 py-1 text-[10px] uppercase tracking-wider text-[#344256]">{{ $customisation }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <a href="https://wa.me/919967132425?text={{ rawurlencode("Hi B.BON, I'd like a quote for {$product->name}.") }}" target="_blank" rel="noreferrer" class="mt-auto pt-7 text-xs font-bold uppercase tracking-widest text-[#111827] hover:text-[#ff1e1e]">Request Quote &rarr;</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div data-cms-products-empty class="hidden border border-[#d5dde8] bg-white p-10 text-center text-[#526178]">No products are currently available in this category.</div>
            @endif
        </div>
    </section>
</template>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var oldFilters = document.querySelector('[x-id="Products_50_6"]');
    var oldGrid = document.querySelector('[x-id="Products_72_6"]');
    var filterTemplate = document.getElementById('cms-products-filter-template');
    var gridTemplate = document.getElementById('cms-products-grid-template');

    if (!oldFilters || !oldGrid || !filterTemplate || !gridTemplate) return;

    oldFilters.replaceWith(filterTemplate.content.cloneNode(true));
    oldGrid.replaceWith(gridTemplate.content.cloneNode(true));

    var buttons = Array.from(document.querySelectorAll('[data-cms-product-filter]'));
    var cards = Array.from(document.querySelectorAll('[data-cms-product-card]'));
    var empty = document.querySelector('[data-cms-products-empty]');

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            var selected = button.dataset.cmsProductFilter;
            var visibleCount = 0;

            buttons.forEach(function (item) {
                var active = item === button;
                item.classList.toggle('bg-[#ff1e1e]', active);
                item.classList.toggle('border-[#ff1e1e]', active);
                item.classList.toggle('text-white', active);
                item.classList.toggle('border-[#262626]', !active);
                item.classList.toggle('text-neutral-300', !active);
            });

            cards.forEach(function (card) {
                var show = selected === 'all' || card.dataset.category === selected;
                card.classList.toggle('hidden', !show);
                if (show) visibleCount++;
            });

            if (empty) empty.classList.toggle('hidden', visibleCount > 0);
        });
    });
});
</script>
