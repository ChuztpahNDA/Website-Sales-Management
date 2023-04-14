<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Products_repository;
use App\Models\Transactions_repository;

class MainController extends Controller
{

    private $Products_DB;
    private $Transactions_DB;

    public function __construct()
    {
        $this->Products_DB = new Products_repository();
        $this->Transactions_DB = new Transactions_repository();
    }

    // Home
    public function index()
    {
        $current_ = Carbon::today()->format('Y-m-d H:i:s');
        $next_ = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($current_)));
        $transactionOnedays =  $this->Transactions_DB->getTransactionsOneDate($current_, $next_);

        $totalTransactionOnedays = count($transactionOnedays);

        // oneday
        $totalRevenueOneDay = 0;
        $totalBenefitOneDay = 0;

        // get detail One Day
        foreach ($transactionOnedays as $transaction) {

            // get total Revenue
            $totalRevenueOneDay += $transaction->TotalPayment - $transaction->Discount;

            // get total Purchase
            $total_purchase = 0;
            $list_orders = $this->Transactions_DB->getOrderByIDTransaction($transaction->ID);
            foreach ($list_orders as $order) {
                // dd($this->main->getProductName($order->Products)[0]->purchaseProduct);
                $total_purchase += $this->Products_DB->getProductName($order->Products)[0]->purchaseProduct * $order->quatity_Products;
            }

            // Total Benefit
            $totalBenefitOneDay = $totalRevenueOneDay - $total_purchase;
        }

        $dataOneDay = [
            'totalRevenueOneDay' => $totalRevenueOneDay,
            'totalBenefitOneDay' => $totalBenefitOneDay,
            'totalTransactionOnedays' => $totalTransactionOnedays
        ];
        $STT = 1;
        return view('main.index', compact('dataOneDay', 'transactionOnedays', 'STT'));
    }
}
