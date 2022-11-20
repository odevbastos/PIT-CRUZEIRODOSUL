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
        Schema::create('fr_usuario', function (Blueprint $table) {
            $table->integer('usr_codigo');
            $table->string('usr_login')->unique();
            $table->string('usr_senha');
            $table->string('usr_administrador');
            $table->string('usr_nome');
            $table->string('usr_email');
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
