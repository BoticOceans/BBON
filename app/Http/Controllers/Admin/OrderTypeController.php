<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrderTypeController extends Controller
{
    public function index(): View
    {
        return view('admin.order-types.index', [
            'items' => OrderType::orderBy('sort_order')->orderBy('name')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.order-types.create', [
            'item' => new OrderType(['is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        OrderType::create($this->validatedData($request));

        return redirect()->route('admin.order-types.index')->with('status', 'Order Type added.');
    }

    public function edit(OrderType $item): View
    {
        return view('admin.order-types.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, OrderType $item): RedirectResponse
    {
        $item->update($this->validatedData($request, $item));

        return redirect()->route('admin.order-types.index')->with('status', 'Order Type updated.');
    }

    public function destroy(OrderType $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('admin.order-types.index')->with('status', 'Order Type deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?OrderType $item = null): array
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('order_types', 'name')->ignore($item),
            ],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
