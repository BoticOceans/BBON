<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ColourController extends Controller
{
    public function index(): View
    {
        return view('admin.colours.index', [
            'items' => Colour::orderBy('sort_order')->orderBy('name')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.colours.create', [
            'item' => new Colour(['is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Colour::create($this->validatedData($request));

        return redirect()->route('admin.colours.index')->with('status', 'Colour added.');
    }

    public function edit(Colour $item): View
    {
        return view('admin.colours.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, Colour $item): RedirectResponse
    {
        $item->update($this->validatedData($request, $item));

        return redirect()->route('admin.colours.index')->with('status', 'Colour updated.');
    }

    public function destroy(Colour $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('admin.colours.index')->with('status', 'Colour deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?Colour $item = null): array
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('colours', 'name')->ignore($item),
            ],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
