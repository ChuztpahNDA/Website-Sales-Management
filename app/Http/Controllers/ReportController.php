<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\main;
use App\Models\Orders_repository;
use App\Models\Products_repository;
use App\Models\Transactions_repository;

class ReportController extends Controller
{
    private $transactions_DB;
    private $products_DB;
    private $Orders_DB;

    public function __construct()
    {
        $this->transactions_DB = new Transactions_repository();
        $this->products_DB = new Products_repository();
        $this->Orders_DB = new Orders_repository();
    }

    // get Revenue
    public function getRevenue()
    {
        // get labels
        $date_array = array(Carbon::today()->format('Y-m-d H:i:s'));
        $labels = array(Carbon::now()->format('d-m-Y'));
        $index = 1;
        $temp = '';
        while ($index < 7) {
            $temp = $temp.' '.$index;
            array_push($date_array, Carbon::today()->subDays($index)->format('Y-m-d H:i:s'));
            array_push($labels, Carbon::today()->subDays($index)->format('d-m-Y'));
            $index++;
        }
        sort($labels);
        sort($date_array);
        // custom day
        $list_Revenues = array();
        $list_Benefits = array();
        $sum_Revenues = 0;
        $sum_Benefits = 0;
        $list_nameProducts =  array();
        $list_transactions = $this->transactions_DB->getTransactionsByTime(7);

        // get detail One Day
        foreach ($date_array as $date) {
            $nextDay =date('Y-m-d H:i:s', strtotime('+1 day', strtotime($date)));
            $transactions = $this->transactions_DB->getTransactionsOneDate($date, $nextDay);
            $RevenueOneDay = 0;
            $purchase = 0;
            // get detail One Day
            foreach ($transactions as $transaction) {
                // get total Revenue
                $RevenueOneDay += $transaction->TotalPayment - $transaction->Discount;
                // get total Purchase
                $orders = $this->transactions_DB->getOrderByIDTransaction($transaction->ID);
                foreach ($orders as $order_) {
                    $product = $this->products_DB->getProductName($order_->Products)[0];
                    $purchase += $product->purchaseProduct * $order_->quatity_Products;
                }
            }
            // Total Benefit
            array_push($list_Revenues, $RevenueOneDay);
            $sum_Revenues += $RevenueOneDay;

            $BenefitOneDay = $RevenueOneDay - $purchase;
            array_push($list_Benefits, $BenefitOneDay);
            $sum_Benefits += $BenefitOneDay;
        }

        $STT = 1;
        $data = [
            'sum_Revenues' => $sum_Revenues,
            'sum_Benefits' => $sum_Benefits
        ];
        return view('main.report.revenue', compact('data', 'STT', 'list_Benefits', 'list_Revenues', 'labels', 'list_transactions'));
    }
}
