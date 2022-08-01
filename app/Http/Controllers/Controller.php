<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var array
     */
    public $data = [];

    /**
     * @param mixed $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param mixed $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param mixed $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __construct()
    {

        $this->middleware(function ($request, $next) {

            $this->checkMigrateStatus();

            // To keep the session we need to move it to middleware
            //$this->gdpr = gdpr_setting();
            $this->global = global_setting();

            $companyName = $this->global->company_name;
            $this->companyName = $companyName;

            $appName = $this->global->app_name;
            $this->appName = $appName;

            $this->taskBoardColumnLength = $this->global->taskboard_length;

            config(['app.name' => $this->companyName]);
            config(['app.url' => url('/')]);

            App::setLocale('fr');
            Carbon::setLocale('fr');
            setlocale(LC_TIME, 'fr' . '_' . strtoupper('fr'));

            if (config('app.env') !== 'development') {
                config(['app.debug' => $this->global->app_debug]);
            }

            if (user()) {
                config(['froiden_envato.allow_users_id' => true]);
            }

            return $next($request);
        });
    }

    public function checkMigrateStatus()
    {
        return check_migrate_status();
    }
}
