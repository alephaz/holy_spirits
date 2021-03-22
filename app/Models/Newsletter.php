<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Newsletter extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes;


    protected $fillable = [

        'language',
        'title',

        'block_a_title',
        'block_a_body',
        'block_a_video',
        'block_a_link',
        'block_a_image_link',

        'block_b_title',
        'block_b_body',
        'block_b_video',
        'block_b_link',
        'block_b_image_link',

        'block_c_title',
        'block_c_body',
        'block_c_video',
        'block_c_link',
        'block_c_image_link',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this
            ->addMediaConversion('block_a_image')
            ->width(730)
            ->height(415)
            ->performOnCollections('block_a_image');

        $this
            ->addMediaConversion('block_b_image')
            ->width(730)
            ->height(415)
            ->performOnCollections('block_b_image');

        $this
            ->addMediaConversion('block_c_image')
            ->width(730)
            ->height(415)
            ->performOnCollections('block_c_image');
    }
}
