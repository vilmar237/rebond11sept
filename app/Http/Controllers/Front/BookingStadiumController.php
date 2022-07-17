<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StadiumBooking;
use Illuminate\Http\Request;
use App\Models\Stadium;
use Carbon\Carbon;

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

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        //S'assurer de l'existence d'au moins un stade && de la disponibilité des horaires choisies en fonction du jour choisi
        if($this->stadium_available())
        {
            //Récupérer les jour et horaires choisis sur le formulaire
            $this->new_date = $request->input('date');
            $this->new_start_time = $request->input('start');
            $this->new_end_time = $request->input('end');

            //Récupérer tous les stades s'il y en a plus d'un - Ceci marchera si on a plus d'un stade aussi

            $this->stadia = Stadium::get();

            //Parcourir les stades afin de vérifier les disponibilités
            foreach ($this->stadia as $stadium) {

                //Vérifier s'il existe des réservations dans la BD
                if ($this->stadium_bookings_exist($stadium)) {

                    //Convertir le format de la date en englais pour MYSQL
                    $this->new_date = date('Y-m-d', strtotime(str_replace('-', '/', $this->new_date)));
                    
                    //Parcourir les réservations et vérifier les heures prises
                    foreach ($stadium->stadium_bookings as $stadium_booking) {

                        //Récupérer les dates, heures de début et de fin occupées
                        $old_date = Carbon::parse($stadium_booking->date)->format('Y-m-d');
                        $old_start_time = Carbon::parse($stadium_booking->start)->format('H:i');
                        $old_end_time = Carbon::parse($stadium_booking->end)->format('H:i');
                        
                        //Vérifier si la date entrée par l'utilisateur est égale à une entrée de date réservée
                        if($old_date == $this->new_date){
                        
                            //Vérifier proprement que les heures réservées par un client actuel ne correspondent pas aux heures occupées
                            $startTime = strtotime($this->new_start_time);
                            $endTime   = strtotime($this->new_end_time);
                            
                            $chkStartTime = strtotime($old_start_time);
                            $chkEndTime   = strtotime($old_end_time);
                            
                            if($chkStartTime > $startTime && $chkEndTime < $endTime)
                            {
                                // L'heure se situe entre l'heure de début et l'heure de fin
                                notify()->error('Plage horaire déjà prise. ', 'Réservation');
                                return redirect('/booking-stadium')->withErrors('Plage horaire déjà prise.');
                            }
                            elseif(($chkStartTime > $startTime && $chkStartTime < $endTime) || ($chkEndTime > $startTime && $chkEndTime < $endTime))
                            {
                                // Vérifier que l'heure de début ou de fin se situe entre l'heure de début et l'heure de fin
                                notify()->error('Plage horaire déjà prise. ', 'Réservation');
                                return redirect('/booking-stadium')->withErrors('Plage horaire déjà prise.');
                            }
                            elseif($chkStartTime==$startTime || $chkEndTime==$endTime)
                            {
                                // Vérifier que l'heure de début ou de fin se situe à la limite de l'heure de début et de fin
                                notify()->error('Plage horaire déjà prise. ', 'Réservation');
                                return redirect('/booking-stadium')->withErrors('Plage horaire déjà prise.');
                            }
                            elseif($startTime > $chkStartTime && $endTime < $chkEndTime)
                            {
                                // l'heure de début et de fin est comprise entre l'heure de début et l'heure de fin de la vérification.
                                notify()->error('Plage horaire déjà prise. ', 'Réservation');
                                return redirect('/booking-stadium')->withErrors('Plage horaire déjà prise.');
                            }
                        }
                         
                    }
                }
                $sn = $stadium->stadium_number;
            }

        }else{
            return redirect('/booking-stadium')->withErrors('Il n\'est pas possible de réserver Rebond pour le moment.');
        }

        $stadium_booking = new StadiumBooking();
        $user = Auth::user();

        $stadium_booking->date = $request->input('date');
        $stadium_booking->start = $request->input('start');
        $stadium_booking->end = $request->input('end');
        $stadium_booking->reason = $request->input('reason');

        /**
         * Trouvez le coût total en comptant le nombre d'heures et en le multipliant par le coût des stades.
         */
        $startTime = Carbon::parse($stadium_booking->start);
        $finishTime = Carbon::parse($stadium_booking->end);
        $no_of_hours = $finishTime->diffInHours($startTime);
        $stadium_booking->stadium_cost = $no_of_hours * 10000;
        $stadium_booking->user_id = $user->id;

        $stadium_booking->stadium_id = $sn;

        $datas['bookings'] = $stadium_booking;
        //dd($datas['bookings']);
        return view('booking_confirmation', compact('datas', 'no_of_hours'));
        //$stadium_booking->save();

        //dd($datas['bookings']);
    }

    //S'il y a au moins un stade dans la BD renvoyer true
    public function stadium_available()
    {
        if($this->stadia_exist())
        {
            return true;
        }else{
            return false;
        }
    }

    //Verifier s'il y a au moins un stade dans la BD
    protected function stadia_exist()
    {
        if (count(Stadium::get()) > 0) {
            return true;
        }
        return false;
    }

    protected function stadium_bookings_exist($stadium)
    {
        if (count($stadium->stadium_bookings) > 0) {
            return true;
        }
    }
}
