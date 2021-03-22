<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{

    use SoftDeletes;
    use HasTranslations;

    public $translatable = [
        'title',
        'body'
    ];

    public $fillable = [
        'title',
        'body'
    ];

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
}
