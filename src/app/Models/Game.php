<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Exceptions\InvalidManipulation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'release_date' => 'date',
        'purchase_date' => 'date',
    ];

    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class);
    }

    public function storefronts(): BelongsToMany
    {
        return $this->belongsToMany(Storefront::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(GameStatus::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(GamePriority::class);
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->performOnCollections('cover')
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->fit(Manipulations::FIT_CROP, 160, 240);

        $this->addMediaConversion('default')
            ->performOnCollections('cover')
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->fit(Manipulations::FIT_CROP, 240, 360);

        $this->addMediaConversion('default')
            ->performOnCollections('hero')
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->fit(Manipulations::FIT_CROP, 1200, 400);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
             ->singleFile()
             ->useFallbackPath(config('filesystems.disks.public.root') . "/fallback/game_default.jpg", 'default')
             ->useFallbackPath(config('filesystems.disks.public.root') . "/fallback/game_thumb.jpg", 'thumb')
             ->useFallbackUrl(config('filesystems.disks.public.url') . "/fallback/game_default.jpg", 'default')
             ->useFallbackUrl(config('filesystems.disks.public.url') . "/fallback/game_thumb.jpg", 'thumb');

        $this->addMediaCollection('hero')
             ->singleFile()
             ->useFallbackPath(config('filesystems.disks.public.root') . "/fallback/platform_hero_default.jpg", 'default')
             ->useFallbackUrl(config('filesystems.disks.public.url') . "/fallback/platform_hero_default.jpg", 'default');
    }
}
