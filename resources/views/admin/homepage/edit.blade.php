@extends('admin.layout')

@section('title', 'Homepage')

@section('content')
    <div class="page-head">
        <div>
            <h1>Homepage Content</h1>
            <p class="sub">Edit every text block, image and list on the public homepage.</p>
        </div>
        <a class="btn" href="{{ route('home') }}" target="_blank" rel="noreferrer">View Homepage</a>
    </div>

    <form method="POST" action="{{ route('admin.homepage.update') }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <section class="panel panel-pad hp-section">
            <h2 class="hp-section-title">Hero</h2>
            <div class="grid-3">
                <div class="field">
                    <label>Eyebrow</label>
                    <input type="text" name="content[hero_eyebrow]" value="{{ $content['hero_eyebrow'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Headline Line 1</label>
                    <input type="text" name="content[hero_title_line1]" value="{{ $content['hero_title_line1'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Headline Lead-in (before highlight)</label>
                    <input type="text" name="content[hero_title_line2_pre]" value="{{ $content['hero_title_line2_pre'] ?? '' }}">
                </div>
            </div>
            <div class="grid-3">
                <div class="field">
                    <label>Headline Highlight Word (red)</label>
                    <input type="text" name="content[hero_title_highlight]" value="{{ $content['hero_title_highlight'] ?? '' }}">
                </div>
                <div class="field" style="grid-column: span 2;">
                    <label>Headline Rest</label>
                    <input type="text" name="content[hero_title_line3]" value="{{ $content['hero_title_line3'] ?? '' }}">
                </div>
            </div>
            <div class="field">
                <label>Subtitle</label>
                <textarea name="content[hero_subtitle]">{{ $content['hero_subtitle'] ?? '' }}</textarea>
            </div>
            <div class="grid-3">
                <div class="field">
                    <label>Primary Button Label</label>
                    <input type="text" name="content[hero_cta_primary_label]" value="{{ $content['hero_cta_primary_label'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Secondary Button Label</label>
                    <input type="text" name="content[hero_cta_secondary_label]" value="{{ $content['hero_cta_secondary_label'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Tertiary Link Label</label>
                    <input type="text" name="content[hero_cta_tertiary_label]" value="{{ $content['hero_cta_tertiary_label'] ?? '' }}">
                </div>
            </div>
            <div class="grid-3">
                <div class="field">
                    <label>Stat 1 Value</label>
                    <input type="text" name="content[hero_stat1_value]" value="{{ $content['hero_stat1_value'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Stat 2 Value</label>
                    <input type="text" name="content[hero_stat2_value]" value="{{ $content['hero_stat2_value'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Stat 3 Value</label>
                    <input type="text" name="content[hero_stat3_value]" value="{{ $content['hero_stat3_value'] ?? '' }}">
                </div>
            </div>
            <div class="grid-3">
                <div class="field">
                    <label>Stat 1 Label</label>
                    <input type="text" name="content[hero_stat1_label]" value="{{ $content['hero_stat1_label'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Stat 2 Label</label>
                    <input type="text" name="content[hero_stat2_label]" value="{{ $content['hero_stat2_label'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Stat 3 Label</label>
                    <input type="text" name="content[hero_stat3_label]" value="{{ $content['hero_stat3_label'] ?? '' }}">
                </div>
            </div>
            <div class="grid-3">
                <div class="field">
                    <label>Hero Image Path</label>
                    <input type="text" name="content[hero_image]" value="{{ $content['hero_image'] ?? '' }}" placeholder="assets/images/example.jpg">
                    @if (! empty($content['hero_image']))
                        <img class="thumb" style="margin-top: 8px;" src="{{ asset($content['hero_image']) }}" alt="">
                    @endif
                </div>
                <div class="field">
                    <label>Upload Hero Image</label>
                    <input type="file" name="image_uploads[hero_image]" accept="image/*">
                    <p class="muted" style="margin-top: 6px;">Uploading replaces the path above.</p>
                </div>
                <div class="field">
                    <label>Hero Image Alt Text</label>
                    <input type="text" name="content[hero_image_alt]" value="{{ $content['hero_image_alt'] ?? '' }}">
                </div>
            </div>
            <div class="grid-3">
                <div class="field">
                    <label>Image Badge Label</label>
                    <input type="text" name="content[hero_image_badge_label]" value="{{ $content['hero_image_badge_label'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Image Badge Title</label>
                    <input type="text" name="content[hero_image_title]" value="{{ $content['hero_image_title'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Image Badge Subtitle</label>
                    <input type="text" name="content[hero_image_subtitle]" value="{{ $content['hero_image_subtitle'] ?? '' }}">
                </div>
            </div>
        </section>

        <section class="panel panel-pad hp-section">
            <h2 class="hp-section-title">Scrolling Ticker</h2>
            <p class="sub" style="margin-bottom: 16px;">Short phrases that scroll across the strip below the hero.</p>
            @include('admin.homepage._block_group', ['group' => 'marquee', 'label' => 'Ticker Items', 'singular' => 'Item', 'showDescription' => false, 'placeholder' => 'e.g. Mumbai Based'])
        </section>

        <section class="panel panel-pad hp-section">
            <h2 class="hp-section-title">Product Catalogue Preview</h2>
            <p class="sub" style="margin-bottom: 16px;">The product grid itself pulls automatically from your live Products (first 8 active products).</p>
            <div class="field">
                <label>Eyebrow</label>
                <input type="text" name="content[catalogue_eyebrow]" value="{{ $content['catalogue_eyebrow'] ?? '' }}">
            </div>
            <div class="field">
                <label>Title</label>
                <input type="text" name="content[catalogue_title]" value="{{ $content['catalogue_title'] ?? '' }}">
            </div>
            <div class="field" style="margin-bottom: 0;">
                <label>Subtitle</label>
                <textarea name="content[catalogue_subtitle]">{{ $content['catalogue_subtitle'] ?? '' }}</textarea>
            </div>
        </section>

        <section class="panel panel-pad hp-section">
            <h2 class="hp-section-title">Custom Sportswear</h2>
            <div class="field">
                <label>Eyebrow</label>
                <input type="text" name="content[custom_eyebrow]" value="{{ $content['custom_eyebrow'] ?? '' }}">
            </div>
            <div class="grid-3">
                <div class="field">
                    <label>Title Line 1</label>
                    <input type="text" name="content[custom_title_line1]" value="{{ $content['custom_title_line1'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Title Line 2</label>
                    <input type="text" name="content[custom_title_line2]" value="{{ $content['custom_title_line2'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Title Highlight (red)</label>
                    <input type="text" name="content[custom_title_highlight]" value="{{ $content['custom_title_highlight'] ?? '' }}">
                </div>
            </div>
            <div class="field">
                <label>Subtitle</label>
                <textarea name="content[custom_subtitle]">{{ $content['custom_subtitle'] ?? '' }}</textarea>
            </div>
            <div class="grid-2">
                <div class="field">
                    <label>Primary Button Label</label>
                    <input type="text" name="content[custom_cta_primary_label]" value="{{ $content['custom_cta_primary_label'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Secondary Button Label</label>
                    <input type="text" name="content[custom_cta_secondary_label]" value="{{ $content['custom_cta_secondary_label'] ?? '' }}">
                </div>
            </div>
            <div class="grid-3">
                <div class="field">
                    <label>Side Image Path</label>
                    <input type="text" name="content[custom_image]" value="{{ $content['custom_image'] ?? '' }}">
                    @if (! empty($content['custom_image']))
                        <img class="thumb" style="margin-top: 8px;" src="{{ asset($content['custom_image']) }}" alt="">
                    @endif
                </div>
                <div class="field">
                    <label>Upload Side Image</label>
                    <input type="file" name="image_uploads[custom_image]" accept="image/*">
                    <p class="muted" style="margin-top: 6px;">Uploading replaces the path above.</p>
                </div>
                <div class="field">
                    <label>Side Image Alt Text</label>
                    <input type="text" name="content[custom_image_alt]" value="{{ $content['custom_image_alt'] ?? '' }}">
                </div>
            </div>
            <div class="grid-2">
                <div class="field">
                    <label>Badge Number</label>
                    <input type="text" name="content[custom_badge_number]" value="{{ $content['custom_badge_number'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Badge Label</label>
                    <input type="text" name="content[custom_badge_label]" value="{{ $content['custom_badge_label'] ?? '' }}">
                </div>
            </div>
            <hr class="hp-divider">
            @include('admin.homepage._block_group', ['group' => 'techniques', 'label' => 'Technique Tags', 'singular' => 'Tag', 'showDescription' => false, 'placeholder' => 'e.g. Embroidery'])
        </section>

        <section class="panel panel-pad hp-section">
            <h2 class="hp-section-title">Who We Serve</h2>
            <div class="field">
                <label>Eyebrow</label>
                <input type="text" name="content[serve_eyebrow]" value="{{ $content['serve_eyebrow'] ?? '' }}">
            </div>
            <div class="field">
                <label>Title</label>
                <input type="text" name="content[serve_title]" value="{{ $content['serve_title'] ?? '' }}">
            </div>
            <div class="field">
                <label>Subtitle</label>
                <textarea name="content[serve_subtitle]">{{ $content['serve_subtitle'] ?? '' }}</textarea>
            </div>
            <hr class="hp-divider">
            @include('admin.homepage._block_group', ['group' => 'services', 'label' => 'Audience Cards', 'singular' => 'Card', 'showDescription' => true, 'placeholder' => 'e.g. Corporates', 'descPlaceholder' => 'e.g. Sports days, off-sites, branded uniforms.'])
        </section>

        <section class="panel panel-pad hp-section">
            <h2 class="hp-section-title">Gallery Preview</h2>
            <p class="sub" style="margin-bottom: 16px;">The image grid pulls automatically from your live Gallery items (featured first, up to 8).</p>
            <div class="field">
                <label>Eyebrow</label>
                <input type="text" name="content[gallery_eyebrow]" value="{{ $content['gallery_eyebrow'] ?? '' }}">
            </div>
            <div class="field">
                <label>Title</label>
                <input type="text" name="content[gallery_title]" value="{{ $content['gallery_title'] ?? '' }}">
            </div>
            <div class="field" style="margin-bottom: 0;">
                <label>Subtitle</label>
                <textarea name="content[gallery_subtitle]">{{ $content['gallery_subtitle'] ?? '' }}</textarea>
            </div>
        </section>

        <section class="panel panel-pad hp-section">
            <h2 class="hp-section-title">About Preview</h2>
            <div class="field">
                <label>Eyebrow</label>
                <input type="text" name="content[about_eyebrow]" value="{{ $content['about_eyebrow'] ?? '' }}">
            </div>
            <div class="field">
                <label>Title</label>
                <input type="text" name="content[about_title]" value="{{ $content['about_title'] ?? '' }}">
            </div>
            <div class="field">
                <label>Subtitle</label>
                <textarea name="content[about_subtitle]">{{ $content['about_subtitle'] ?? '' }}</textarea>
            </div>
            <div class="grid-3">
                <div class="field">
                    <label>Image Path</label>
                    <input type="text" name="content[about_image]" value="{{ $content['about_image'] ?? '' }}">
                    @if (! empty($content['about_image']))
                        <img class="thumb" style="margin-top: 8px;" src="{{ asset($content['about_image']) }}" alt="">
                    @endif
                </div>
                <div class="field">
                    <label>Upload Image</label>
                    <input type="file" name="image_uploads[about_image]" accept="image/*">
                    <p class="muted" style="margin-top: 6px;">Uploading replaces the path above.</p>
                </div>
                <div class="field">
                    <label>Image Alt Text</label>
                    <input type="text" name="content[about_image_alt]" value="{{ $content['about_image_alt'] ?? '' }}">
                </div>
            </div>
            <div class="grid-3">
                <div class="field">
                    <label>Location Label</label>
                    <input type="text" name="content[about_location_label]" value="{{ $content['about_location_label'] ?? '' }}">
                </div>
                <div class="field">
                    <label>Location Value</label>
                    <input type="text" name="content[about_location_value]" value="{{ $content['about_location_value'] ?? '' }}">
                </div>
                <div class="field">
                    <label>"Read More" Link Label</label>
                    <input type="text" name="content[about_cta_label]" value="{{ $content['about_cta_label'] ?? '' }}">
                </div>
            </div>
            <hr class="hp-divider">
            @include('admin.homepage._block_group', ['group' => 'features', 'label' => 'Highlight Cards', 'singular' => 'Card', 'showDescription' => true, 'placeholder' => 'e.g. 30+ Years', 'descPlaceholder' => 'e.g. Sportswear Crafting'])
        </section>

        <section class="panel panel-pad hp-section">
            <h2 class="hp-section-title">How It Works</h2>
            <div class="field">
                <label>Eyebrow</label>
                <input type="text" name="content[process_eyebrow]" value="{{ $content['process_eyebrow'] ?? '' }}">
            </div>
            <div class="field">
                <label>Title</label>
                <input type="text" name="content[process_title]" value="{{ $content['process_title'] ?? '' }}">
            </div>
            <div class="field">
                <label>Subtitle</label>
                <textarea name="content[process_subtitle]">{{ $content['process_subtitle'] ?? '' }}</textarea>
            </div>
            <hr class="hp-divider">
            @include('admin.homepage._block_group', ['group' => 'process_steps', 'label' => 'Steps (in order)', 'singular' => 'Step', 'showDescription' => true, 'placeholder' => 'e.g. Share Requirement', 'descPlaceholder' => 'e.g. Tell us product, quantity, fabric & branding needs.'])
        </section>

        <section class="panel panel-pad hp-section">
            <h2 class="hp-section-title">Bottom CTA Band</h2>
            <div class="field">
                <label>Title</label>
                <input type="text" name="content[cta_title]" value="{{ $content['cta_title'] ?? '' }}">
            </div>
            <div class="field" style="margin-bottom: 0;">
                <label>Subtitle</label>
                <textarea name="content[cta_subtitle]">{{ $content['cta_subtitle'] ?? '' }}</textarea>
            </div>
        </section>

        <div class="actions" style="margin-top: 4px; position: sticky; bottom: 16px;">
            <button class="btn btn-red" type="submit">Save Homepage Content</button>
        </div>
    </form>

    <script>
        window.__blockSeq = window.__blockSeq || {};
        document.querySelectorAll('.block-group').forEach(function (group) {
            var groupName = group.dataset.group;
            window.__blockSeq[groupName] = group.querySelectorAll('.block-item').length;
        });

        function addBlockItem(group, showDescription) {
            var template = document.getElementById('block-template-' + group);
            var container = document.getElementById('block-container-' + group);
            var index = window.__blockSeq[group]++;
            var html = template.innerHTML.replaceAll('__INDEX__', index);
            var wrapper = document.createElement('div');
            wrapper.innerHTML = html.trim();
            container.appendChild(wrapper.firstElementChild);
        }

        function removeBlockItem(button) {
            var item = button.closest('.block-item');
            var container = item.parentElement;
            if (container.querySelectorAll('.block-item').length <= 1) {
                item.querySelectorAll('input[type=text]').forEach(function (el) { el.value = ''; });
                return;
            }
            item.remove();
        }
    </script>
@endsection
