<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryItemController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery-items.index', [
            'galleryItems' => GalleryItem::orderByDesc('is_featured')
                ->orderBy('sort_order')
                ->orderBy('title')
                ->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.gallery-items.create', [
            'galleryItem' => new GalleryItem(['is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        GalleryItem::create($this->validatedData($request));

        return redirect()->route('admin.gallery-items.index')->with('status', 'Gallery item added.');
    }

    public function edit(GalleryItem $galleryItem): View
    {
        return view('admin.gallery-items.edit', compact('galleryItem'));
    }

    public function update(Request $request, GalleryItem $galleryItem): RedirectResponse
    {
        $data = $this->validatedData($request, $galleryItem);

        if (($data['image_path'] ?? null) !== $galleryItem->image_path) {
            $this->deleteUploadedImage($galleryItem->image_path);
        }

        $galleryItem->update($data);

        return redirect()->route('admin.gallery-items.index')->with('status', 'Gallery item updated.');
    }

    public function destroy(GalleryItem $galleryItem): RedirectResponse
    {
        $this->deleteUploadedImage($galleryItem->image_path);
        $galleryItem->delete();

        return redirect()->route('admin.gallery-items.index')->with('status', 'Gallery item deleted.');
    }

    /** @return array<string, mixed> */
    private function validatedData(Request $request, ?GalleryItem $galleryItem = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'caption' => ['nullable', 'string', 'max:1000'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'image_path' => [$galleryItem ? 'nullable' : 'required_without:image_file', 'nullable', 'string', 'max:255'],
            'image_file' => [$galleryItem ? 'nullable' : 'required_without:image_path', 'nullable', 'image', 'max:6144'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['alt_text'] = ($data['alt_text'] ?? null) ?: $data['title'];

        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->storeUploadedImage($request);
        } elseif (blank($data['image_path'] ?? null) && $galleryItem?->image_path) {
            $data['image_path'] = $galleryItem->image_path;
        }

        unset($data['image_file']);

        return $data;
    }

    private function storeUploadedImage(Request $request): string
    {
        $file = $request->file('image_file');
        $directory = public_path('uploads/gallery');

        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            .'-'.Str::random(8)
            .'.'.$file->getClientOriginalExtension();

        $file->move($directory, $filename);

        return 'uploads/gallery/'.$filename;
    }

    private function deleteUploadedImage(?string $path): void
    {
        if (! $path || ! str_starts_with($path, 'uploads/gallery/')) {
            return;
        }

        $fullPath = public_path($path);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}
