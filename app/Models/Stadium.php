<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stadia';

    protected $fillable = ['stadium_number', 'description', 'available', 'status'];

    public function stadium_bookings()
    {
        return $this->hasMany('App\Models\StadiumBooking');
    }

    public function reviews()
    {
        return $this->hasManyThrough('App\Models\Review', 'App\Models\StadiumBooking');

    }
}
