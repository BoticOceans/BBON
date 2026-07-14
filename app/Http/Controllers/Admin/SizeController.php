<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SizeController extends Controller
{
    public function index(): View
    {
        return view('admin.sizes.index', [
            'items' => Size::orderBy('sort_order')->orderBy('name')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.sizes.create', [
            'item' => new Size(['is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Size::create($this->validatedData($request));

        return redirect()->route('admin.sizes.index')->with('status', 'Size added.');
    }

    public function edit(Size $item): View
    {
        return view('admin.sizes.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, Size $item): RedirectResponse
    {
        $item->update($this->validatedData($request, $item));

        return redirect()->route('admin.sizes.index')->with('status', 'Size updated.');
    }

    public function destroy(Size $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('admin.sizes.index')->with('status', 'Size deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?Size $item = null): array
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sizes', 'name')->ignore($item),
            ],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
