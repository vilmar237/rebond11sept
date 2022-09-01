<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StadiumBooking;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sum_amount = StadiumBooking::where('payment', 1)->sum('stadium_cost');
        $orders = StadiumBooking::count();
        return view('admin.home',compact('sum_amount','orders'));
    }
}
