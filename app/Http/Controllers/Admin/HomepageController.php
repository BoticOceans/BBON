<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageBlock;
use App\Models\HomepageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HomepageController extends Controller
{
    /**
     * Content keys that hold an image path and can be replaced via upload.
     *
     * @var list<string>
     */
    private const IMAGE_KEYS = ['hero_image', 'custom_image', 'about_image'];

    public function edit(): View
    {
        $content = HomepageContent::query()->pluck('value', 'key');

        $blocks = [];
        foreach (array_keys(HomepageBlock::GROUPS) as $group) {
            $items = HomepageBlock::query()->ofGroup($group)->ordered()->get();
            $blocks[$group] = $items->isEmpty() ? [new HomepageBlock(['group' => $group])] : $items;
        }

        return view('admin.homepage.edit', [
            'content' => $content,
            'blocks' => $blocks,
            'groups' => HomepageBlock::GROUPS,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'content' => ['array'],
            'content.*' => ['nullable', 'string'],
            'image_uploads' => ['array'],
            'image_uploads.*' => ['nullable', 'image', 'max:6144'],
            'blocks' => ['array'],
            'blocks.*' => ['array'],
            'blocks.*.*.id' => ['nullable', 'integer'],
            'blocks.*.*.title' => ['nullable', 'string', 'max:255'],
            'blocks.*.*.description' => ['nullable', 'string', 'max:1000'],
        ]);

        $existing = HomepageContent::query()->pluck('value', 'key');

        foreach (self::IMAGE_KEYS as $key) {
            if ($request->hasFile("image_uploads.$key")) {
                $newPath = $this->storeUploadedImage($request->file("image_uploads.$key"));
                $this->deleteUploadedImage($existing[$key] ?? null);
                $data['content'][$key] = $newPath;
            }
        }

        DB::transaction(function () use ($data) {
            foreach ($data['content'] ?? [] as $key => $value) {
                HomepageContent::query()->updateOrInsert(['key' => $key], ['value' => $value]);
            }

            foreach ($data['blocks'] ?? [] as $group => $items) {
                if (! array_key_exists($group, HomepageBlock::GROUPS)) {
                    continue;
                }

                $keptIds = [];

                foreach (array_values($items) as $index => $item) {
                    $title = trim($item['title'] ?? '');

                    if ($title === '') {
                        continue;
                    }

                    $payload = [
                        'group' => $group,
                        'title' => $title,
                        'description' => $item['description'] ?? null,
                        'sort_order' => $index,
                        'is_active' => true,
                    ];

                    $existingId = $item['id'] ?? null;
                    $block = $existingId ? HomepageBlock::query()->where('group', $group)->find($existingId) : null;

                    if ($block) {
                        $block->update($payload);
                        $keptIds[] = $block->id;
                    } else {
                        $keptIds[] = HomepageBlock::query()->create($payload)->id;
                    }
                }

                HomepageBlock::query()->ofGroup($group)->whereNotIn('id', $keptIds)->delete();
            }
        });

        HomepageContent::forget();

        return redirect()->route('admin.homepage.edit')->with('status', 'Homepage content updated.');
    }

    private function storeUploadedImage(UploadedFile $file): string
    {
        $directory = public_path('uploads/homepage');

        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            .'-'.Str::random(8)
            .'.'.$file->getClientOriginalExtension();

        $file->move($directory, $filename);

        return 'uploads/homepage/'.$filename;
    }

    private function deleteUploadedImage(?string $path): void
    {
        if (! $path || ! str_starts_with($path, 'uploads/homepage/')) {
            return;
        }

        $fullPath = public_path($path);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}
