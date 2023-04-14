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
        // Products tabel
        Schema::create('products', function(Blueprint $table){
            $table -> bigIncrements('ID');
            $table -> string('URLImages')->nullable();
            $table -> string('nameProduct');
            $table -> BigInteger('quatity');
            $table -> string('priceProduct');
            $table -> string('purchaseProduct');
            $table -> string('description');
            $table -> string('created_at');
            $table -> string('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
};
