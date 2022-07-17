<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Algo\Booking;
use Carbon\Carbon;

class StadiumAvailableRule implements Rule
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
        //dd('ds');
        $this->new_date = $new_date;
        $this->new_start_time = $new_start_time;
        $this->new_end_time = $new_end_time;

        $booking = new Booking($this->new_date, $this->new_start_time, $this->new_end_time);
        return $booking->stadium_available();
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
        $booking = new Booking($this->new_date, $this->new_start_time, $this->new_end_time);
        return $booking->stadium_available();
    }
}
