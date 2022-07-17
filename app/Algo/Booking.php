<?php

namespace App\Algo;

use App\Models\Stadium;
use Carbon\Carbon;

class Booking
{
    protected $date;
    protected $new_start_time;
    protected $new_end_time;
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($new_date, $new_start_time, $new_end_time)
    {
        $this->new_date = $new_date;
        $this->new_start_time = $new_start_time;
        $this->new_end_time = $new_end_time;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->stadium_available();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Désolé, le stade n\'est pas disponible aux dates indiquées. Veuillez essayer une autre date.';
    }

    public function stadium_available()
    {
        $this->stadia_exist();

        $this->stadia = Stadium::get();
        
        foreach ($this->stadia as $stadium) {

            if ($this->stadium_bookings_exist($stadium)) {
                if($this->stadium_bookings_check($stadium->stadium_bookings) == false)
                    continue;
            }
            return $stadium->stadium_number;
        }
        

    }

    protected function stadia_exist()
    {
        if (count(Stadium::get()) > 0) {
            return true;
        }
        $this->message = "Désolé, stade non disponible.";
        return false;
    }

    protected function stadium_bookings_exist($stadium)
    {
        if (count($stadium->stadium_bookings) > 0) {
            return true;
        }
    }

    protected function stadium_bookings_check($stadium_bookings)
    {
        foreach ($stadium_bookings as $stadium_booking) {
            $old_start_time = Carbon::parse($stadium_booking->start)->format('H:i');
            $old_end_time = Carbon::parse($stadium_booking->end)->format('H:i');

            if ($this->new_start_time < $old_start_time) {
                if ($this->new_end_time > $old_start_time)
                    return false;
            }elseif ($this->new_start_time > $old_start_time) {
                if ($this->new_start_time < $old_end_time) {
                    return false;
                }
            }elseif ($this->new_start_time == $old_start_time) {
                return false;
            }
        }
        return true;
    }

}