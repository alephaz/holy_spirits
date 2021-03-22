<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Role extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',             // String
        'slug',             // String
        'permissions'       // JSON
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

//    /**
//     * Get permission attribute
//     * @param $value
//     * @return Collection|null
//     */
//    public function getPermissionsAttribute($value): ?Collection
//    {
//        // check if the model attribute has a string value
//        if (is_string($value) && strlen($value)) {
//
//            // convert the string to a json object in order to validate
//            $permission_obj = \GuzzleHttp\json_decode($value);
//
//            // if the object is valid, convert it to a collection and return
//            if (is_object($permission_obj)) {
//                return collect((array)$permission_obj);
//            }
//        }
//
//        return null;
//    }

    /**
     * Get all the users for the role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * Get all the video channels for the role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function video_channels()
    {
        return $this->belongsToMany('App\Models\VideoChannel');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

}
