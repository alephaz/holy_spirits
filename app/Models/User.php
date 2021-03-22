<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'locale',

        'first_name',                   // string
        'last_name',                    // string
        'gender',                       // enum
        'birth_date',                   // date

        'address',                      // string
        'city',                         // string
        'state',                        // string
        'zip',                          // string
        'country',                      // string
        'telephone_phone',              // string
        'mobile_phone',                 // sting
        'routing_number',               // string
        'account_number',               // string
        'monthly_donation_amount',      // int
        'newsletter_subscription',      // int
        'last_login'                    // date
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = [
        'roles'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'email_verified_at',
        'last_login',
        'birth_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

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
     * Check if the current user has the user role requested
     *
     * @param Builder $builder
     * @param Role $role
     * @return bool
     */
    public function scopeHasRole(Builder $builder, Role $role): bool
    {
        if ($this->roles->pluck('id')->search($role->id) > -1) {
            return true;
        }

        return false;
    }

}
