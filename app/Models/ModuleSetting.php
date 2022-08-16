<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleSetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function checkModule($moduleName)
    {

        $user = user();

        $module = ModuleSetting::where('module_name', $moduleName);

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

        $module = $module->first();

        return $module ? true : false;
    }
}
