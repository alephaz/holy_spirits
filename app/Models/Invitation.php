<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'church_name',
        'email',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'telephone_phone',
        'mobile_phone',
        'website',
        'event_type',
        'venue_capacity',
        'expected_attendance',
        'tentative_dates',
        'previous_event_details',
        'message',
        'newsletter_subscription'
    ];
}
