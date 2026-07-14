<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class HomepageContent extends Model
{
    use HasFactory;

    protected $table = 'homepage_content';

    protected $fillable = ['key', 'value'];

    public const CACHE_KEY = 'homepage_content_map';

    /**
     * @return array<string, string>
     */
    public static function map(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return static::query()->pluck('value', 'key')->all();
        });
    }

    public static function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
