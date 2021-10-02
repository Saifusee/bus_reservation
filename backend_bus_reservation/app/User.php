<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_verified', 'isadmin', 'password', 'contact_1', 'contact_2', 'contact_3', 'contact_4',
        'greetings', 'terms_and_conditions', 'note_1', 'note_2'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Functions from JWT Package.
     *
     * @var array
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    //Eloquent Relationships
    public function partner_travels()
    {
        return $this->hasMany('App\PartnerTravel');
    }

    public function pickup_points()
    {
        return $this->hasMany('App\PickupPoint');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
