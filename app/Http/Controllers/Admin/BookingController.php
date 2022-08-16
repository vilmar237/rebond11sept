<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AccountBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\DataTables\BookingsDataTable;
use App\Models\StadiumBooking;
use Illuminate\Http\Request;

class BookingController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            
            abort_403(!in_array('clients', $this->user->modules));
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewPermission = user()->permission('order.view');

        $stadium_bookings = StadiumBooking::all();

        return view('admin.booking.index', compact('stadium_bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stadium_booking = StadiumBooking::find($id);

        return view('admin.booking.edit',compact('stadium_booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stadium_booking = StadiumBooking::findOrFail($id);

        $rules = [
            'status' => 'in:pending,checked_in,checked_out,cancelled',
            'payment' => 'boolean'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $stadium_booking->status = $request->input('status');
        $stadium_booking->payment = $request->input('payment');
        $stadium_booking->save();

        Session::flash('flash_title', 'Success');
        Session::flash('flash_message', 'Réservation mise à jour avec succès.');
        return redirect('/admin/booking');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
