<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Rules\StadiumAvailableRule;
use App\Models\StadiumBooking;
use Illuminate\Http\Request;
use Carbon\Carbon;
//use App\Algo\Booking;

class BookingStadiumController extends FrontController
{
    public function show()
    {
        return view('reservation');
    }

    public function book(Request $request)
    {
        //check here if the user is authenticated
        if (!Auth::check()) {
            notify()->warning('Veuillez vous authentifier au préalable ', 'Authentification requise');
            return Redirect::to("/login");
        }

        $rules = [
            'name' => 'required|string|min:3',
            'reason' => 'required||in:1,2,3,4,5',
            'date' => 'required|date_format:Y/m/d|after_or_equal:today',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i|after:'.$request->input('start'),
        ];

        $messages = [
            'name.required' => 'Un nom d\'activité est requis.',
            'name.min' => 'Le nom d\'activité doit être au minimum de 3 caractères.',
            'reason.required' => 'Le motif de l\'activité est requis.',
            'reason.in' => 'Le motif doit être celui de la liste proposée.',
            'date.required' => 'La date est requise.',
            'date.date_format' => 'Format de date non valide.',
            'date.after_or_equal' => 'La date doit être une date postérieure ou égale à celle du jour.',
            'start.required' => 'L\'heure de début est requise.',
            'start.date_format' => 'Format de l\'heure de début non valide.',
            'end.required' => 'L\'heure de fin est requise.',
            'end.date_format' => 'Format de l\'heure de fin non valide.',
            'end.after' => 'L\'heure de fin doit être supèrieure à celle de début.',
            
        ];

        $new_date = $request->input('date');
        $new_start_time = $request->input('start');
        $new_end_time = $request->input('end');
        $rules['booking_validation'] = [new StadiumAvailableRule($new_date, $new_start_time, $new_end_time)];
        //dd($rules['booking_validation']);
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $stadium_booking = new StadiumBooking();
        $user = Auth::user();

        $stadium_booking->start = $request->input('start');
        $stadium_booking->end = $request->input('end');

        /**
         * Trouvez le coût total en comptant le nombre d'heures et en le multipliant par le coût des stades.
         */
        $startTime = Carbon::parse($stadium_booking->start);
        $finishTime = Carbon::parse($stadium_booking->end);
        $no_of_hours = $finishTime->diffInHours($startTime);
        $stadium_booking->stadium_cost = $no_of_hours * 10000;
        $stadium_booking->user_id = $user->id;

        dd($request->date);
    }
}
