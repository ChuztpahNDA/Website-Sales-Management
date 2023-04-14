<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customers_repository extends Model
{
    use HasFactory;

    //====================
    // Customer

    // add customer
    public function addCustomers($name, $phoneNumber, $address)
    {
        DB::table('customers')->insert([
            'nameCustomer' => $name,
            'phoneNumber' => $phoneNumber,
            'Address' => $address,
        ]);
    }

    // get all costomer
    public function getCustomers()
    {
        return DB::table('customers')
            ->select('*')
            ->get();
    }

    // get customer by ID
    public function getCustomerID($id)
    {
        return DB::table('customers')
            ->select('*')
            ->where('ID', '=', $id)
            ->get();
    }

    // get customer by name
    public function getCustomerName($name)
    {
        return DB::table('customers')
            ->select('*')
            ->where('nameCustomer', '=', $name)
            ->get();
    }

    // edit customer by ID
    public function editCustomer($id, $data)
    {
        DB::table('customers')
            ->where('ID', '=', $id)
            ->update($data);
    }
}
