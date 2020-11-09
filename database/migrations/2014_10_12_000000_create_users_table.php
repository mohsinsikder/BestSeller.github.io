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
            $table->string('name');
            $table->string('addresss')->default(0);
            $table->string('city')->default(0);
            $table->string('state')->default(0);
            $table->string('country')->default(0);
            $table->string('pincode')->default(0);
            $table->string('mobile')->default(0);
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('status');
            $table->timestamp('email_verified_at')->nullable();
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
