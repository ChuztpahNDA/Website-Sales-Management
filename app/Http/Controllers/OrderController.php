<?php

namespace App\Http\Controllers;

use App\Models\Customers_repository;
use Illuminate\Http\Request;
use App\Models\Orders_repository;
use App\Models\Products_repository;
use App\Models\Transactions_repository;

class OrderController extends Controller
{
    private $Orders_DB;
    private $Products_DB;
    private $Transactions_DB;
    private $Customers_DB;

    public function __construct()
    {
        $this->Orders_DB = new Orders_repository();
        $this->Products_DB = new Products_repository();
        $this->Transactions_DB = new Transactions_repository();
        $this->Customers_DB = new Customers_repository();

    }

    //=================================
    // Orders
    public function getOrders()
    {
        $Transactions = $this->Transactions_DB->getTransactions();
        return view('main.orders.getOrders', compact('Transactions'));
    }

    // get form add order
    public function getAddOrders(Request  $request)
    {
        $Customers = $this->Customers_DB->getCustomers();
        $Products = $this->Products_DB->getProducts();
        return view('main.orders.getAddOrders', compact('Customers', 'Products'));
    }

    // add order
    public function addOrders(Request $request)
    {
        $CustomerDetail = explode('-', $request->Customer_detail);
        $ProductDetail = explode(';', $request->ProductListID);
        $created_at = date("Y-m-d H:i:s");
        $discount = $request->discount;
        $totalpayment = 0;
        $arrProduct = array();
        $arrQuatity = array();
        $arrPrice = array();
        $msg = " ";
        $msgErr = " ";
        // Product detail
        if (count($ProductDetail) > 1) {
            $ProductID = $ProductDetail[0];

            foreach ($ProductDetail as $product) {
                if ($product != "") {
                    $name = str_replace(' ', '_', $product);
                    $detail = $this->Products_DB->getProductName($product);
                    $totalpayment += ($request->$name) * $detail[0]->priceProduct;
                    array_push($arrProduct, $detail[0]->nameProduct);
                    array_push($arrQuatity, $request->$name);
                    array_push($arrPrice, $detail[0]->priceProduct);
                }
            }
        } else {
            $msgErr = "Chưa chọn khách hàng";
        }

        //Customer detail
        if (count($CustomerDetail) > 1) {
            $CustomerName = $CustomerDetail[0];

            // insert transaction
            $dataTransaction = [
                "Customers" => $CustomerName,
                "TotalPayment" => $totalpayment - $discount,
                "Discount" => $discount,
                "created_at" => $created_at
            ];
            $this->Transactions_DB->insertTransaction($dataTransaction);


            // insert order
            $TransactionID = $this->Transactions_DB->getIDmax();
            if (!empty($arrProduct)) {
                for ($index = 0; $index < count($arrProduct); $index++) {
                    $dataOrder = [
                        "Customers" => $CustomerName,
                        "ID_Transactions" => $TransactionID,
                        "Products" => $arrProduct[$index],
                        "quatity_Products" => $arrQuatity[$index],
                        "Payment" => $arrPrice[$index] * $arrQuatity[$index],
                        "created_at" => $created_at
                    ];
                    $this->Orders_DB->insertOrders($dataOrder);
                    $msg = "Tạo đơn hàng thành công";
                }
            } else {
                $msgErr = "Chưa thêm sản phẩm";
            }
        }

        // data show
        $Customers = $this->Customers_DB->getCustomers();
        $Products = $this->Products_DB->getProducts();
        // dd($msg, $msgErr);
        return view('main.orders.getAddOrders', compact("Customers", "Products", "msg", "msgErr"));
    }

    // get order detail
    public function ordersDetail(Request $request)
    {
        $id = $request->id;
        $Transactions = $this->Transactions_DB->getTransactionsID($id)[0];
        $Customers = $this->Customers_DB->getCustomerName($Transactions->Customers)[0];
        $Orders = $this->Transactions_DB->getOrderByIDTransaction($id);
        // dd($Orders);
        return view('main.orders.orderDetail', compact('Customers', 'Transactions', 'Orders'));
    }
}
