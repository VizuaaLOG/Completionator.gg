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

class DownloadableContent extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    protected $table = 'downloadable_content';

    protected $casts = [
        'release_date' => 'date',
        'purchase_date' => 'date',
        'completed_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        self::saving(function(DownloadableContent $dlc) {
            if(
                $dlc->status_id == GameStatus::COMPLETED
                && is_null($dlc->completed_at)
            ) {
                $dlc->completed_at = now();
            } else if($dlc->status_id != GameStatus::COMPLETED) {
                $dlc->completed_at = null;
            }
        });
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class, 'downloadable_content_platforms');
    }

    public function storefronts(): BelongsToMany
    {
        return $this->belongsToMany(Storefront::class, 'downloadable_content_storefronts');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(GameStatus::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(GamePriority::class);
    }

    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'downloadable_content_developers');
    }

    public function publishers(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'downloadable_content_publishers');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'downloadable_content_genres');
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
             ->useFallbackPath(public_path('fallback-media/game_default.jpg'), 'default')
             ->useFallbackPath(public_path('fallback-media/game_thumb.jpg'), 'thumb')
             ->useFallbackUrl(asset('fallback-media/game_default.jpg'), 'default')
             ->useFallbackUrl(asset('fallback-media/game_thumb.jpg'), 'thumb');

        $this->addMediaCollection('hero')
             ->singleFile()
             ->useFallbackPath(public_path('fallback-media/platform_hero_default.jpg'), 'default')
             ->useFallbackUrl(asset('fallback-media/platform_hero_default.jpg'), 'default');
    }
}
