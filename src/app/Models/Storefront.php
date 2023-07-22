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

class Storefront extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('default')
            ->performOnCollections('icon')
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->fit(Manipulations::FIT_CROP, 64, 64);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')
             ->singleFile()
             ->useFallbackPath(public_path("fallback-media/storefront_default.jpg"), 'default')
             ->useFallbackUrl(asset("fallback-media/storefront_default.jpg"), 'default');
    }
}
