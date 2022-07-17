<?php

namespace Database\Seeders;

use anlutro\LaravelSettings\Facade as Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::set('company_name', 'Rebond');
        Setting::set('institute_name', 'Rebond');
        Setting::set('company_logo', '');
        Setting::set('company_email', 'contact@rebond.cm');
        Setting::set('sup_admin_email', 'mbia1378@gmail.com');
        Setting::set('company_phone', '+237695035506');
        Setting::set('company_address', 'Douala');
        Setting::set('company_city', 'Douala');
        Setting::set('company_currency_symbol', 'XAF');
        Setting::set('site_copyright', 'Tous droits reservés');
        Setting::set('driver', 'smtp');
        Setting::set('host', 'smtp.gmail.com');
        Setting::set('port', '465');
        Setting::set('user_name', 'mbia1378@gmail.com');
        Setting::set('password', 'wjdewrnywtpnyyoe');
        Setting::set('encryption', 'ssl');
        Setting::set('status', 1);
        Setting::set('from_address', 'mbia1378@gmail.com');
        Setting::set('from_name', 'REBOND');
        Setting::set('last_updated_email_settings_by', '');
        Setting::set('last_updated_siteinfo_settings_by', '');
        Setting::set('record_per_page', 15);
        Setting::set('default_role', 7);
        Setting::set('max_login_attempts', 3);
        Setting::set('lockout_delay', 5);
        Setting::set('language_switcher', 'on');
        Setting::set('language_show_as', 'default');

        Setting::set('time_zone', 'WAT');
        Setting::set('date_format', 'd M, Y');
        Setting::set('h:i A','');
        //SMS
        Setting::set('application_id', '1Qn59hGdEJL3W68q');
        Setting::set('client_id', 'kAqw3kGRdoiOXwi9RzAh5AMJ8aigLBVr');
        Setting::set('client_secret', 'a0HUR6jRFSGi6y8z');
        Setting::set('authorization_header', 'Basic a0FxdzNrR1Jkb2lPWHdpOVJ6QWg1QU1KOGFpZ0xCVnI6YTBIVVI2alJGU0dpNnk4eg==');
        Setting::save();
    }
}
