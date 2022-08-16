<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ModuleSetting;

class CreateModuleSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module_name');
            $table->enum('status', ['active', 'disabled']);
            $table->timestamps();
        });

        $modules = [
            ['module_name' => 'supers', 'status' => 'active'],
            ['module_name' => 'clients', 'status' => 'active'],
            ['module_name' => 'employees', 'status' => 'active'],
            ['module_name' => 'estimates', 'status' => 'active'],
            ['module_name' => 'invoices', 'status' => 'active'],
            ['module_name' => 'payments', 'status' => 'active'],
            ['module_name' => 'expenses', 'status' => 'active'],
            ['module_name' => 'tickets', 'status' => 'active'],
            ['module_name' => 'messages', 'status' => 'active'],
            ['module_name' => 'events', 'status' => 'active'],
            ['module_name' => 'notices', 'status' => 'active'],
            ['module_name' => 'orders', 'status' => 'active'],
        ];

        ModuleSetting::insert($modules);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_settings');
    }
}
