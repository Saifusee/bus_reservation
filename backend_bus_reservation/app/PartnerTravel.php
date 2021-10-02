<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerTravel extends Model
{
    use SoftDeletes;
    protected $table = 'partner_travels';

    protected $fillable = [
        'partner_travel_name', 'email_1', 'email_2', 'address', 'description',
        'contact_1', 'contact_2', 'contact_3', 'contact_4', 'contact_5',
        'contact_6', 'contact_7', 'contact_8', 'contact_9', 'contact_10', 'user_id'
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
