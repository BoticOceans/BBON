<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_category_id',
        'order_type_id',
        'collar_id',
        'fabric_id',
        'colour_id',
        'patch_id',
        'label',
        'front',
        'back',
        'sleeves',
        'sizes',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sizes' => 'array',
            'sort_order' => 'integer',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function orderType(): BelongsTo
    {
        return $this->belongsTo(OrderType::class);
    }

    public function collar(): BelongsTo
    {
        return $this->belongsTo(Collar::class);
    }

    public function fabric(): BelongsTo
    {
        return $this->belongsTo(Fabric::class);
    }

    public function colour(): BelongsTo
    {
        return $this->belongsTo(Colour::class);
    }

    public function patch(): BelongsTo
    {
        return $this->belongsTo(Patch::class);
    }

    public function totalQuantity(): int
    {
        return array_sum(array_map('intval', $this->sizes ?? []));
    }
}
