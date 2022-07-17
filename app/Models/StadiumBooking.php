<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StadiumBooking extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stadium_bookings';

    protected $casts = [
        'start' => 'date:hh:mm',
        'end' => 'date:hh:mm'
    ];

    protected $fillable = ['date', 'start', 'end', 'stadium_cost', 'reason', 'status', 'payment', 'stadium_id', 'user_id'];

    /**
     * Get the gallery that owns the image.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function stadium()
    {
        return $this->belongsTo('App\Models\Stadium');
    }

    public function review()
    {
        return $this->hasOne('App\Models\Review');
    }
}
