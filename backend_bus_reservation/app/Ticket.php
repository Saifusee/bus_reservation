<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rc', 'from_location', 'to_location', 'booking_date', 'departure_date', 'passenger_name', 'passenger_contact_1',
        'passenger_contact_2', 'email', 'reporting_time', 'departure_time', 'sleeper_no', 'seat_no',
        'bus_no', 'total_seats', 'amount', 'advance', 'is_cancel', 'user_id', 'pickup_point_id', 'partner_travel_id',
    ];

    //Eloquent Relationships
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function partner_travel()
    {
        return $this->belongsTo('App\PartnerTravel');
    }

    public function pickup_point()
    {
        return $this->belongsTo('App\PickupPoint');
    }
}
