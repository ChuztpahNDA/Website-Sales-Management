<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products_repository extends Model
{
    use HasFactory;
    public $timestamps = true;
    // Products
    public function addProducts($data)
    {
        DB::table('products')->insert([$data]);
    }

    // get all product
    public function getProducts()
    {
        return DB::table('products')
            ->select('*')
            ->orderBy("created_at", 'desc')
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
}
