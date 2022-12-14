<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterModuleSettingTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('module_settings', function(Blueprint $table){
            $table->enum('type', ['Super','Admin','Customer'])->default('Super')->after('status');
        });

        $moduleSettings = \App\Models\ModuleSetting::all();
        
        foreach($moduleSettings as $moduleSetting){
            $modules = new \App\Models\ModuleSetting();
            $modules->module_name = $moduleSetting->module_name;
            $modules->type = 'Admin';
            $modules->save();
            $modulesClient = new \App\Models\ModuleSetting();
            $modulesClient->module_name = $moduleSetting->module_name;
            $modulesClient->type = 'Customer';
            $modulesClient->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('module_settings', function(Blueprint $table){
            //$table->dropColumn(['type']);
        });
    }

}
