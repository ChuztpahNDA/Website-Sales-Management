<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transactions_repository extends Model
{
    use HasFactory;

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

    // get order by ID transactions
    public function getOrderByIDTransaction($id)
    {
        return DB::table('orders')
                ->select('*')
                ->where("ID_Transactions", "=", $id)
                ->get();
    }
}
