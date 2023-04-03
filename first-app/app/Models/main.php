<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class main extends Model
{
    use HasFactory;


    // Products
    public function addProducts($name, $quatity, $price,  $purchase, $nameImage, $description_products)
    {
        DB::table('products')->insert([
            'nameProduct' => $name,
            'quatity' => $quatity,
            'priceProduct' => $price,
            'purchaseProduct' => $purchase,
            'URLImages' => $nameImage,
            'description' => $description_products
        ]);
    }

    // get all product
    public function getProducts()
    {
        return DB::table('products')
            ->select('*')
            ->get();
    }

    // get product by ID
    public function getProductID($id)
    {
        return DB::table('products')
            ->select('*')
            ->where('ID', '=', $id)
            ->get();
    }

    // get product by name
    public function getProductName($name)
    {
        return DB::table('products')
            ->select('*')
            ->where('nameProduct', '=', $name)
            ->get();
    }

    // edit product by ID
    public function editProduct($id, $data)
    {
        DB::table('products')
            ->where('ID', '=', $id)
            ->update($data);
    }


    // delete product by ID
    public function deleteProduct($id)
    {
        DB::table('products')
            ->where('ID', '=', $id)
            ->delete();
    }

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


    // =========Orders================

    //get transactions
    public function getTransactions()
    {
        return DB::table('transactions')
                ->select('*')
                ->get();
    }

    //get transactions by ID
    public function getTransactionsID($id)
    {
        return DB::table('transactions')
                ->select('*')
                ->where("ID", '=', $id)
                ->get();
    }

    //get transactions by time
    public function getTransactionsByTime($date)
    {
        return DB::table('transactions')
                ->select('*')
                ->where('created_at','>=', Carbon::now()->subDays($date))
                ->orderBy('created_at', 'desc')
                ->get();
    }

    //get transactions one time
    public function getTransactionsOneDate($time, $nextTime)
    {
        return DB::table('transactions')
                ->select('*')
                ->where('created_at','>=', $time)
                ->where('created_at','<', $nextTime)
                ->orderBy('created_at', 'desc')
                ->get();
    }

    // insert transaction
    public function insertTransaction($data)
    {
        DB::table('transactions')->insert([$data]);
    }

    // get transaction by ID
    public function getTransactionByIDcus($CustomerID)
    {
        return DB::table('transactions')
            ->select('*')
            ->where('ID_Customers', '=', $CustomerID)
            ->get();
    }

    //get ID max
    public function getIDmax()
    {
        return DB::table('transactions')->max('ID');
    }


    // insert order
    public function insertOrders($data)
    {
        DB::table('orders')->insert([$data]);
    }

    // get order by ID transactions
    public function getOrderByIDTransaction($id)
    {
        return DB::table('orders')
                ->select('*')
                ->where("ID_Transactions", "=", $id)
                ->get();
    }
}
