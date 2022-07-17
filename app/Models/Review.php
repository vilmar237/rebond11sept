<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    protected $fillable = ['review', 'rating', 'approval_status', 'stadium_booking_id'];

    public function stadium_booking(){

        return $this->belongsTo('App\Models\StadiumBooking');
    }
}
