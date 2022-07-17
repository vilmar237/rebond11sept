<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('address')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('role', ['Super', 'Admin', 'Customer']);
            $table->timestamp('email_verified_at')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('password');
            $table->string('random_key')->nullable();
            $table->string("activation_code")->nullable();
            $table->tinyInteger("is_active")->default(0)->nullable();
            $table->string('about', 300)->nullable();
            $table->string('facebook_id', 191)->unique()->nullable();
            $table->string('twitter_id', 191)->unique()->nullable();
            $table->string('google_id', 191)->unique()->nullable();
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
