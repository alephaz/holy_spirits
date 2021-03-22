<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'message',
        'newsletter_subscription',
        'request_type'
    ];
}
