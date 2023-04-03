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
        // Schema::create('products', function(Blueprint $table){
        //     $table -> bigIncrements('ID');
        //     $table -> string('URLImages')->nullable();
        //     $table -> string('nameProduct');
        //     $table -> BigInteger('quatity');
        //     $table -> string('priceProduct');
        //     $table -> string('purchaseProduct');
        //     $table -> string('description');
        // });

        // // Customer tabel
        // Schema::create('customers', function(Blueprint $table){
        //     $table -> bigIncrements('ID');
        //     $table -> string('nameCustomer');
        //     $table -> string('phoneNumber');
        //     $table -> string('Address');
        // });

        // // Transaction tabel
        // Schema::create('Transactions', function(Blueprint $table){
        //     $table -> bigIncrements('ID');
        //     $table -> string('Customers');
        //     $table -> string('TotalPayment');
        //     $table -> string('Discount');
        //     $table -> timestamps();
        // });

        // // Orders tabel
        // Schema::create('Orders', function(Blueprint $table){
        //     $table -> bigIncrements('ID');
        //     $table -> string('Customers');
        //     $table -> string('ID_Transactions');
        //     $table -> string('Products');
        //     $table -> bigInteger('quatity_Products');
        //     $table -> string('Payment');
        //     $table -> timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::drop('products');
    // }
};
