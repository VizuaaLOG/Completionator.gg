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

class Company extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'established_date' => 'date',
    ];

    public function published_games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_publishers');
    }

    public function developed_games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_developers');
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->performOnCollections('logo')
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->fit(Manipulations::FIT_FILL, 160, 240);

        $this->addMediaConversion('default')
            ->performOnCollections('logo')
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->fit(Manipulations::FIT_FILL, 240, 360);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
             ->singleFile()
             ->useFallbackPath(public_path('fallback-media/game_default.jpg'), 'default')
             ->useFallbackPath(public_path('fallback-media/game_thumb.jpg'), 'thumb')
             ->useFallbackUrl(asset('fallback-media/game_default.jpg'), 'default')
             ->useFallbackUrl(asset('fallback-media/game_thumb.jpg'), 'thumb');
    }
}
