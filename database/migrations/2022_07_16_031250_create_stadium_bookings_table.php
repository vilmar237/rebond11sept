<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadiumBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stadium_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stadium_id')->unsigned()->index();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->date('date');
            $table->time("start")->nullable();
            $table->time("end")->nullable();
            $table->integer('stadium_cost');
            $table->enum('status', ['pending', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
            $table->boolean('payment')->default(false);
            $table->timestamps();

            $table->foreign('stadium_id')
                ->references('id')->on('stadia')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stadium_bookings');
    }
}
