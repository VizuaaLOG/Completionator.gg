<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Exceptions\InvalidManipulation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Platform extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'purchase_date' => 'date',
        'release_date' => 'date',
    ];

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('icon')
            ->performOnCollections('cover')
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->fit(Manipulations::FIT_CROP, 64, 64);

        $this->addMediaConversion('thumb')
            ->performOnCollections('cover')
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->fit(Manipulations::FIT_CROP, 240, 240);

        $this->addMediaConversion('default')
            ->performOnCollections('cover')
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->fit(Manipulations::FIT_CROP, 360, 360);

        $this->addMediaConversion('default')
            ->performOnCollections('hero')
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->fit(Manipulations::FIT_CROP, 1200, 400);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
             ->singleFile()
             ->useFallbackPath(config('filesystems.disks.public.root') . "/fallback/platform_default.jpg", 'default')
             ->useFallbackPath(config('filesystems.disks.public.root') . "/fallback/platform_thumb.jpg", 'thumb')
             ->useFallbackPath(config('filesystems.disks.public.root') . "/fallback/platform_icon.jpg", 'icon')
             ->useFallbackUrl(config('filesystems.disks.public.url') . "/fallback/platform_default.jpg", 'default')
             ->useFallbackUrl(config('filesystems.disks.public.url') . "/fallback/platform_thumb.jpg", 'thumb')
             ->useFallbackUrl(config('filesystems.disks.public.url') . "/fallback/platform_icon.jpg", 'icon');

        $this->addMediaCollection('hero')
             ->singleFile()
             ->useFallbackPath(config('filesystems.disks.public.root') . "/fallback/platform_hero_default.jpg", 'default')
             ->useFallbackUrl(config('filesystems.disks.public.url') . "/fallback/platform_hero_default.jpg", 'default');
    }
}
