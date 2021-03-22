<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Translatable\HasTranslations;

class Video extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes;
    use HasTranslations;

    public $translatable = [
        'title',
        'description'
    ];

    protected $fillable = [
        'language',             // enum [en, es, iw]
        'title',                // varchar 255
        'description',          // text
        'slug',                 // varchar 255
        'youtube_image',        // varchar 255
        'youtube_link',         // varchar 255
        'vimeo_link',           // varchar 255
        'custom_video_image',   // varchar 255
        'video_link',           // varchar 255
        'type',                 // enum [youtube, custom]
        'location',             // varchar 255
        'country',              // int
        'weight',               // int
        'created_at',
        'updated_at'
    ];

    protected $with = [
        'channels'
    ];

    public function channels()
    {
        return $this->belongsToMany('App\Models\VideoChannel');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this
            ->addMediaConversion('video_cover')
            ->width(730)
            ->height(415)
            ->performOnCollections('youtube_image');

        $this
            ->addMediaConversion('video_cover')
            ->width(730)
            ->height(415)
            ->performOnCollections('custom_video_image');
    }

    /**
     * Set slug attribute
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        // check if a slug exists and use it, if nothing found use the title
        if ($value && strlen($value)) {
            $this->attributes['slug'] = str_slug($value);
        } else {
            $this->attributes['slug'] = str_slug($this->title);
        }
    }

    public function scopeGetYoutubeCode(Builder $builder)
    {
        if ($this->link && strlen($this->link)) {

            $matches = preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $this->link, $output_array);

            if (isset($output_array[7])) {
                return $output_array[7];
            }
            return false;
        }
    }

    public function scopeVideoJson()
    {

        $youtube_image_url = null;

        $youtube_image = $this->getFirstMedia('youtube_image');

        if ($youtube_image) {
            $youtube_image_url = $youtube_image->getUrl('video_cover');
        }

        $custom_video_image_url = null;

        $custom_image = $this->getFirstMedia('custom_video_image');

        if ($custom_image) {
            $custom_video_image_url = $custom_image->getUrl('video_cover');
        }

        return \GuzzleHttp\json_encode([
            'id' => $this->id,
            'country_code' => strtolower($this->country),
            'country' => config('countries.' . $this->country. '.' . app()->getLocale()),
            'location' => $this->location,
            'title' => $this->title,
            'description' => $this->description,
            'youtube_link' => $this->youtube_link,
            'video_link' => $this->video_link,
            'youtube_image' => $youtube_image_url,
            'custom_video_image' => $custom_video_image_url,
            'type' => $this->type
        ]);
    }
}
