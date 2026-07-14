<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PatchController extends Controller
{
    public function index(): View
    {
        return view('admin.patches.index', [
            'items' => Patch::orderBy('sort_order')->orderBy('name')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.patches.create', [
            'item' => new Patch(['is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Patch::create($this->validatedData($request));

        return redirect()->route('admin.patches.index')->with('status', 'Patch added.');
    }

    public function edit(Patch $item): View
    {
        return view('admin.patches.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, Patch $item): RedirectResponse
    {
        $item->update($this->validatedData($request, $item));

        return redirect()->route('admin.patches.index')->with('status', 'Patch updated.');
    }

    public function destroy(Patch $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('admin.patches.index')->with('status', 'Patch deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?Patch $item = null): array
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('patches', 'name')->ignore($item),
            ],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
