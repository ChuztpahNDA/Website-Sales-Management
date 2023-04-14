<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders_repository extends Model
{
    use HasFactory;

    // insert order
    public function insertOrders($data)
    {
        DB::table('orders')->insert([$data]);
    }
}
