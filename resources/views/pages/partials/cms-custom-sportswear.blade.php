<template id="cms-pick-products-template">
    <section class="bg-[#141414] border-y border-[#262626] py-20 sm:py-28" data-cms-pick-products>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-left max-w-3xl mb-14">
                <div class="inline-flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.25em] text-[#ff1e1e] mb-5">
                    <span class="w-8 h-px bg-[#ff1e1e]"></span>Sportswear We Customise
                </div>
                <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight text-white leading-[0.95]">Pick Your Product. We'll Make It Custom.</h2>
            </div>
            @if ($pickProducts->isEmpty())
                <div class="border border-[#262626] bg-[#0a0a0a] p-10 text-center">
                    <h3 class="font-display text-2xl font-black uppercase text-white">Catalogue Coming Soon</h3>
                    <p class="mt-3 text-neutral-400">Contact us for current products and bulk pricing.</p>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach ($pickProducts as $product)
                        <a class="group relative overflow-hidden bg-[#0a0a0a] border border-[#262626] hover:border-[#ff1e1e] transition-colors" href="{{ route('products') }}#{{ $product->slug }}">
                            <div class="aspect-square overflow-hidden">
                                @if ($product->image_path)
                                    <img alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ asset($product->image_path) }}">
                                @endif
                            </div>
                            <div class="p-4 flex items-center justify-between">
                                <span class="font-display text-sm font-bold uppercase text-white tracking-wide">{{ $product->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 text-neutral-500 group-hover:text-[#ff1e1e] group-hover:translate-x-1 transition-all" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</template>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var oldSection = document.querySelector('[x-id="CustomSportswear_90_6"]');
    var template = document.getElementById('cms-pick-products-template');

    if (!oldSection || !template) return;

    oldSection.replaceWith(template.content.cloneNode(true));
});
</script>
