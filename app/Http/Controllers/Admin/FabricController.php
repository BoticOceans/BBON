<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fabric;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FabricController extends Controller
{
    public function index(): View
    {
        return view('admin.fabrics.index', [
            'items' => Fabric::orderBy('sort_order')->orderBy('name')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.fabrics.create', [
            'item' => new Fabric(['is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Fabric::create($this->validatedData($request));

        return redirect()->route('admin.fabrics.index')->with('status', 'Fabric added.');
    }

    public function edit(Fabric $item): View
    {
        return view('admin.fabrics.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, Fabric $item): RedirectResponse
    {
        $item->update($this->validatedData($request, $item));

        return redirect()->route('admin.fabrics.index')->with('status', 'Fabric updated.');
    }

    public function destroy(Fabric $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('admin.fabrics.index')->with('status', 'Fabric deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?Fabric $item = null): array
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('fabrics', 'name')->ignore($item),
            ],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
