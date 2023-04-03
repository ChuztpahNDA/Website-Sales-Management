<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('UserAccounts', function(Blueprint $table){
            $table -> bigIncrements('ID');
            $table -> string('fullName');
            $table -> string('email');
            $table -> string('password');
            $table -> date('birthDay');
            $table -> string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('UserAccounts');
    }
};
