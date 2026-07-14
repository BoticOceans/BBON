<template id="cms-gallery-filter-template">
    <section class="border-b border-[#262626] bg-[#0a0a0a] sticky top-20 z-30 backdrop-blur-xl" data-cms-gallery-filters>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 overflow-x-auto">
            <div class="flex gap-2 min-w-max">
                <button type="button" data-cms-gallery-filter="all" class="px-4 py-2.5 text-xs font-semibold uppercase tracking-widest transition-colors border bg-[#ff1e1e] text-white border-[#ff1e1e]">All</button>
                @foreach ($galleryCategories as $category)
                    <button type="button" data-cms-gallery-filter="{{ Str::slug($category) }}" class="px-4 py-2.5 text-xs font-semibold uppercase tracking-widest transition-colors border border-[#262626] text-neutral-300 hover:border-white hover:text-white">{{ $category }}</button>
                @endforeach
            </div>
        </div>
    </section>
</template>

<template id="cms-gallery-grid-template">
    <section class="py-16 sm:py-20" data-cms-gallery-grid>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($galleryItems->isEmpty())
                <div class="border border-[#262626] bg-[#141414] p-10 text-center">
                    <h3 class="font-display text-2xl font-black uppercase text-white">Gallery Coming Soon</h3>
                    <p class="mt-3 text-neutral-400">New custom sportswear work will be added here shortly.</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach ($galleryItems as $galleryItem)
                        <article data-cms-gallery-card data-category="{{ Str::slug($galleryItem->category) }}" class="group relative overflow-hidden bg-[#141414] border border-[#262626] aspect-square {{ $galleryItem->is_featured ? 'sm:col-span-2 sm:row-span-2' : '' }}">
                            <img src="{{ asset($galleryItem->image_path) }}" alt="{{ $galleryItem->alt_text ?: $galleryItem->title }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/5 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute inset-x-0 bottom-0 p-4 sm:p-5">
                                @if ($galleryItem->category)
                                    <p class="text-[#ff1e1e] text-[10px] font-bold uppercase tracking-[0.2em]">{{ $galleryItem->category }}</p>
                                @endif
                                <h3 class="mt-1 text-white font-display font-black uppercase text-sm sm:text-lg">{{ $galleryItem->title }}</h3>
                                @if ($galleryItem->caption)
                                    <p class="mt-1 text-xs text-neutral-300 hidden sm:block">{{ $galleryItem->caption }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
                <div data-cms-gallery-empty class="hidden border border-[#262626] bg-[#141414] p-10 text-center text-neutral-400">No gallery images are currently available in this category.</div>
            @endif
        </div>
    </section>
</template>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var oldFilters = document.querySelector('[x-id="Gallery_25_6"]');
    var oldGrid = document.querySelector('[x-id="Gallery_47_6"]');
    var filterTemplate = document.getElementById('cms-gallery-filter-template');
    var gridTemplate = document.getElementById('cms-gallery-grid-template');

    if (!oldFilters || !oldGrid || !filterTemplate || !gridTemplate) return;

    oldFilters.replaceWith(filterTemplate.content.cloneNode(true));
    oldGrid.replaceWith(gridTemplate.content.cloneNode(true));

    var buttons = Array.from(document.querySelectorAll('[data-cms-gallery-filter]'));
    var cards = Array.from(document.querySelectorAll('[data-cms-gallery-card]'));
    var empty = document.querySelector('[data-cms-gallery-empty]');

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            var selected = button.dataset.cmsGalleryFilter;
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
