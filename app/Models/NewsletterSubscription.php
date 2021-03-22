<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsletterSubscription extends Model
{
    use PhpListSupport; //, SoftDeletes;

    protected $fillable = [
        'email',
        'language' // the active language of the web site will be added here
    ];
}
