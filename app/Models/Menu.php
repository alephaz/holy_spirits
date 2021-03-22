<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{

    use HasTranslations;
    use SoftDeletes;


    protected $translatable = [
        'title',
        'description'
    ];

    protected $fillable = [
        'id',
        'title',
        'description',
        'slug',
        'weight',
        'menu_id'
    ];

    protected $with = [
        'parent_menu'
    ];

    public function parent_menu()
    {
        return $this->hasOne('App\Models\Menu');
    }
}
