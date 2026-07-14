<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageBlock extends Model
{
    use HasFactory;

    public const GROUPS = [
        'marquee' => 'Scrolling Ticker',
        'techniques' => 'Custom Sportswear Techniques',
        'services' => 'Who We Serve',
        'features' => 'About Highlights',
        'process_steps' => 'How It Works Steps',
    ];

    protected $fillable = [
        'group',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeOfGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
