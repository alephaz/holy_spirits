<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Translatable\HasTranslations;

class MultiMedia extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes;
    use HasTranslations;


    protected $translatable = [
        'title',
        'description'
    ];

    protected $fillable = [
        'title',        // json
        'description',  // json
        'type',         // enum
        'data',         // json
        'thumb',        // string
        'language',     // string
    ];


    public function registerMediaConversions(Media $media = null)
    {
        $this
            ->addMediaConversion('thumbnail')
            ->width(730)
            ->height(415)
            ->performOnCollections('thumb_image');
    }
}
