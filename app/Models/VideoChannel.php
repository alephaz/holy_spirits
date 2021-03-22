<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


class VideoChannel extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = [
        'title'
    ];

    protected $fillable = [
        'title',            // varchar 255
        'machine_name',     // varchar 255
        'slug',             // varchar 255
        'description',      // text
        'weight',           // int
        'display_in_menu'   // int
    ];

    protected $with = [
        'roles'
    ];


    /**
     * Set slug attribute
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($this->title);
    }

    public function setMachineNameAttribute($value)
    {
        if ($value) {
            $this->attributes['machine_name'] = snake_case($value);
        }
    }

    /**
     * Get all the user roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * Get all the videos for the channel
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function videos()
    {
        return $this->belongsToMany('App\Models\Video');
    }
}