<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PickupPoint extends Model
{
    use SoftDeletes;
    protected $table = 'pickup_points';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pickup_point_address', 'user_id'
    ];

    //Eloquent Relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
