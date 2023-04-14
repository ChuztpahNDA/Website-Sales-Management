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
         // Orders tabel
         Schema::create('orders', function(Blueprint $table){
            $table -> bigIncrements('ID');
            $table -> string('Customers');
            $table -> string('ID_Transactions');
            $table -> string('Products');
            $table -> bigInteger('quatity_Products');
            $table -> string('Payment');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
