<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces And Routes
|--------------------------------------------------------------------------
|
| When a module starting, this file will executed automatically. This helps
| to register some namespaces like translator or view. Also this file
| will load the routes file for each module. You may also modify
| this file as you want.
|
*/

use Illuminate\Support\Facades\Artisan;

if (!function_exists('user')) {

    /**
     * Return current logged in user
     */
    function user()
    {
        if (session()->has('user')) {
            return session('user');
        }

        $user = auth()->user();

        if ($user) {
            session(['user' => $user]);
            return session('user');
        }

        return null;
    }

}

if (!function_exists('global_setting')) {

    // @codingStandardsIgnoreLine
    function global_setting()
    {
        if (!session()->has('global_setting')) {
            $setting = \App\Models\Setting::first();
            session(['global_setting' => $setting]);
        }

        return session('global_setting');
    }

}

if (!function_exists('check_migrate_status')) {

    // @codingStandardsIgnoreLine
    function check_migrate_status()
    {

        if (!session()->has('check_migrate_status')) {

            $status = Artisan::call('migrate:check');

            if ($status && !request()->ajax()) {
                Artisan::call('migrate', array('--force' => true)); // Migrate database
                Artisan::call('optimize:clear');
            }

            session(['check_migrate_status' => 'Good']);
        }

        return session('check_migrate_status');
    }

}

if (!function_exists('abort_403')) {

    /**
     * @param mixed $condition
     */

    // @codingStandardsIgnoreLine
    function abort_403($condition)
    {
        abort_if($condition, 403, __('messages.permissionDenied'));
    }

}

if (!function_exists('isSeedingData')) {

    /**
     * Check if app is seeding data
     * @return boolean
     */
    function isSeedingData()
    {
        // We set config(['app.seeding' => true]) at the beginning of each seeder. And check here
        return config('app.seeding');
    }

}

if (!function_exists('isRunningInConsoleOrSeeding')) {

    /**
     * Check if app is seeding data
     * @return boolean
     */
    function isRunningInConsoleOrSeeding()
    {
        // We set config(['app.seeding' => true]) at the beginning of each seeder. And check here
        return app()->runningInConsole() || isSeedingData();
    }

}

if (!function_exists('user_roles')) {

    /**
     * Return current logged in user
     */
    // @codingStandardsIgnoreLine
    function user_roles()
    {
        if (session()->has('user_roles')) {
            return session('user_roles');
        }

        $user = user();

        if ($user) {
            session(['user_roles' => user()->roles->pluck('name')->toArray()]);
            return session('user_roles');
        }

        return null;
    }

}

if (!function_exists('user_modules')) {

    // @codingStandardsIgnoreLine
    function user_modules()
    {
        if (!session()->has('user_modules') && user()) {
            $user = auth()->user();

            $module = new \App\Models\ModuleSetting();

            if (in_array('Super', user_roles())) {
                $module = $module->where('type', 'Super');
            }
            elseif (in_array('Admin', user_roles())) {
                $module = $module->where('type', 'Admin');
            }
            elseif (in_array('Customer', user_roles())) {
                $module = $module->where('type', 'Customer');
            }

            $module = $module->where('status', 'active');
            $module->select('module_name');

            $module = $module->get();
            $moduleArray = [];

            foreach ($module->toArray() as $item) {
                array_push($moduleArray, array_values($item)[0]);
            }

            session(['user_modules' => $moduleArray]);

        }

        return session('user_modules');

    }

}