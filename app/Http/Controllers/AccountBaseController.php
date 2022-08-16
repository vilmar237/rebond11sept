<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountBaseController extends Controller
{
    /**
     * UserBaseController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!isRunningInConsoleOrSeeding()) {
            $this->currentRouteName = request()->route()->getName();

        }

        $this->middleware(function ($request, $next) {

            $this->user = user();
            $this->modules = $this->user->modules;

            
            return $next($request);
        });

    }
}
