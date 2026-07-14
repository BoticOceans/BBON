<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CollarController extends Controller
{
    public function index(): View
    {
        return view('admin.collars.index', [
            'items' => Collar::orderBy('sort_order')->orderBy('name')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.collars.create', [
            'item' => new Collar(['is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Collar::create($this->validatedData($request));

        return redirect()->route('admin.collars.index')->with('status', 'Collar added.');
    }

    public function edit(Collar $item): View
    {
        return view('admin.collars.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, Collar $item): RedirectResponse
    {
        $item->update($this->validatedData($request, $item));

        return redirect()->route('admin.collars.index')->with('status', 'Collar updated.');
    }

    public function destroy(Collar $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('admin.collars.index')->with('status', 'Collar deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?Collar $item = null): array
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('collars', 'name')->ignore($item),
            ],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
