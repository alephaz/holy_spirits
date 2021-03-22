<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'address',
        'city',
        'state',
        'zip_code',
        'telephone',
        'routing_number',
        'account_number',
        'monthly_contribution',
        'donation_amount',
        'newsletter_subscription',
        'pay_pal_payment'
    ];
}
