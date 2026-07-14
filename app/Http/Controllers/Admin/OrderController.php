<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collar;
use App\Models\Colour;
use App\Models\Fabric;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderType;
use App\Models\Patch;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();

        $orders = Order::query()
            ->withCount('items')
            ->with('items')
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->orderByDesc('order_date')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders.index', [
            'orders' => $orders,
            'statuses' => Order::STATUSES,
            'activeStatus' => $status,
        ]);
    }

    public function create(): View
    {
        $nextNumber = (Order::max('id') ?? 0) + 1;

        return view('admin.orders.create', array_merge($this->formOptions(), [
            'order' => new Order([
                'order_no' => 'ORD-'.str_pad((string) $nextNumber, 5, '0', STR_PAD_LEFT),
                'order_date' => now()->toDateString(),
                'status' => 'pending',
            ]),
            'items' => [new OrderItem()],
        ]));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        DB::transaction(function () use ($data) {
            $order = Order::create($this->orderFields($data));
            $this->syncItems($order, $data['items']);
        });

        return redirect()->route('admin.orders.index')->with('status', 'Order created.');
    }

    public function edit(Order $order): View
    {
        $order->load('items');

        return view('admin.orders.edit', array_merge($this->formOptions(), [
            'order' => $order,
            'items' => $order->items->isEmpty() ? [new OrderItem()] : $order->items,
        ]));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $data = $this->validatedData($request, $order);

        DB::transaction(function () use ($data, $order) {
            $order->update($this->orderFields($data));
            $this->syncItems($order, $data['items']);
        });

        return redirect()->route('admin.orders.index')->with('status', 'Order updated.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('status', 'Order deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function formOptions(): array
    {
        return [
            'categories' => ProductCategory::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'orderTypes' => OrderType::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'collars' => Collar::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'fabrics' => Fabric::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'colours' => Colour::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'patches' => Patch::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'sizes' => Size::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'statuses' => Order::STATUSES,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?Order $order = null): array
    {
        return $request->validate([
            'order_no' => [
                'required',
                'string',
                'max:50',
                Rule::unique('orders', 'order_no')->ignore($order),
            ],
            'order_date' => ['required', 'date'],
            'delivery_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(array_keys(Order::STATUSES))],
            'customer_name' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['nullable', 'integer'],
            'items.*.product_category_id' => ['nullable', 'integer', 'exists:product_categories,id'],
            'items.*.order_type_id' => ['nullable', 'integer', 'exists:order_types,id'],
            'items.*.collar_id' => ['nullable', 'integer', 'exists:collars,id'],
            'items.*.fabric_id' => ['nullable', 'integer', 'exists:fabrics,id'],
            'items.*.colour_id' => ['nullable', 'integer', 'exists:colours,id'],
            'items.*.patch_id' => ['nullable', 'integer', 'exists:patches,id'],
            'items.*.label' => ['nullable', 'string', 'max:100'],
            'items.*.front' => ['nullable', 'string', 'max:255'],
            'items.*.back' => ['nullable', 'string', 'max:255'],
            'items.*.sleeves' => ['nullable', 'string', 'max:255'],
            'items.*.sizes' => ['nullable', 'array'],
            'items.*.sizes.*' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function orderFields(array $data): array
    {
        return [
            'order_no' => $data['order_no'],
            'order_date' => $data['order_date'],
            'delivery_date' => $data['delivery_date'] ?? null,
            'status' => $data['status'],
            'customer_name' => $data['customer_name'] ?? null,
            'notes' => $data['notes'] ?? null,
        ];
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function syncItems(Order $order, array $items): void
    {
        $keptIds = [];

        foreach (array_values($items) as $index => $itemData) {
            $sizes = collect($itemData['sizes'] ?? [])
                ->map(fn ($qty) => (int) $qty)
                ->filter(fn ($qty) => $qty > 0)
                ->toArray();

            $isBlank = $sizes === []
                && blank($itemData['label'] ?? null)
                && blank($itemData['product_category_id'] ?? null)
                && blank($itemData['front'] ?? null)
                && blank($itemData['back'] ?? null)
                && blank($itemData['sleeves'] ?? null);

            $payload = [
                'product_category_id' => $itemData['product_category_id'] ?? null,
                'order_type_id' => $itemData['order_type_id'] ?? null,
                'collar_id' => $itemData['collar_id'] ?? null,
                'fabric_id' => $itemData['fabric_id'] ?? null,
                'colour_id' => $itemData['colour_id'] ?? null,
                'patch_id' => $itemData['patch_id'] ?? null,
                'label' => $itemData['label'] ?? null,
                'front' => $itemData['front'] ?? null,
                'back' => $itemData['back'] ?? null,
                'sleeves' => $itemData['sleeves'] ?? null,
                'sizes' => $sizes,
                'sort_order' => $index,
            ];

            $existingId = $itemData['id'] ?? null;

            if ($existingId) {
                $item = $order->items()->find($existingId);

                if ($item) {
                    if ($isBlank) {
                        continue;
                    }

                    $item->update($payload);
                    $keptIds[] = $item->id;

                    continue;
                }
            }

            if ($isBlank) {
                continue;
            }

            $newItem = $order->items()->create($payload);
            $keptIds[] = $newItem->id;
        }

        $order->items()->whereNotIn('id', $keptIds)->delete();
    }
}
