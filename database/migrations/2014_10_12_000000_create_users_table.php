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
            $table->integer('belongs')->nullable();
            $table->string('site_name');
            $table->string('surname')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->string('pages')->nullable();
            $table->string('picture')->nullable();
            $table->integer('role')->default('0');
            $table->boolean('isVerified')->default(false);
            $table->string('password');
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
