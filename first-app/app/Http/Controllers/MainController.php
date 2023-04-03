<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\main;
use App\Imports\ProductImport;
use App\Exports\template;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class MainController extends Controller
{

    private $main;

    public function __construct()
    {
        $this->main = new main();
    }

    // Home
    public function index()
    {
        $current_ = Carbon::today()->format('Y-m-d H:i:s');
        $next_ = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($current_)));
        $transactionOnedays =  $this->main->getTransactionsOneDate($current_, $next_);

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
            $list_orders = $this->main->getOrderByIDTransaction($transaction->ID);
            foreach ($list_orders as $order) {
                // dd($this->main->getProductName($order->Products)[0]->purchaseProduct);
                $total_purchase += $this->main->getProductName($order->Products)[0]->purchaseProduct * $order->quatity_Products;
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

    // get Products list
    public function getProducts()
    {
        $productlists = $this->main->getProducts();
        return view('main.products.getProducts', ['productlists' => $productlists]);
    }

    // get form add Products
    public function getAddProducts()
    {
        return view('main.products.addProducts');
    }

    // add product
    public function Addproducts(Request $request)
    {
        $request->validate(
            [
                "name_products" => 'required|unique:products',
                "quantity_products" => 'required|numeric|min:0',
                "description_products" => 'required',
            ],
            [
                "name_products.unique" => "Sản phẩm đã tồn tại",
                "name_products.required" => "Không được để trống",
                "quantity_products.required" => "Không được để trống",
                "quantity_products.numeric" => "Phải nhập là chữ số",
                "quantity_products.min" => "Số lượng không được âm",
                "description_products.required" => "Mô tả không được để trống"
            ]
        );

        $nameProducts = $request->name_products;
        $quatityProducts = $request->quantity_products;
        $priceProducts = $request->price_products;
        $purchaseProducts = $request->purchase_products;
        $description_products = $request->description_products;
        $nameImages = $request->productsImage;
        $nameDB = '';

        if (!empty($nameImages)) {
            // lấy phần mở rộng của file image
            $extension = $nameImages->getClientOriginalExtension();

            // create name insert database
            $nameDB =  $nameProducts . '.' . $extension;

            //move image to folder image in public
            $nameImages->move(public_path('assets/clients/images/Products'), $nameDB);
        }

        $this->main->addProducts($nameProducts, $quatityProducts, $priceProducts, $purchaseProducts, $nameDB, $description_products);

        return view('main.products.addProducts', ['message' => 'Thêm sản phẩm thành công']);
    }


    //  get form edit Product
    public function getEditProducts(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $product = $this->main->getProductID($id)[0];
            if (!empty($product)) {
                $request->session()->put('id', $id);
            } else {
                return back()->with('msg', 'Sản phẩm không tồn tại');
            }
        } else {
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        return view('main.products.editProducts', compact('product'));
    }

    //Edit Product
    public function editProduct(Request $request)
    {
        $id = session('id');
        if (!empty($id)) {
            $request->validate(
                [
                    "name_products" => 'required',
                    "quantity_products" => 'required|numeric|min:0'
                ],
                [
                    "name_products.required" => "Không được để trống",
                    "quantity_products.required" => "Không được để trống",
                    "quantity_products.numeric" => "Phải nhập là chữ số",
                    "quantity_products.min" => "Số lượng không được âm"
                ]
            );

            $nameProducts = $request->name_products;
            $quatityProducts = $request->quantity_products;
            $priceProducts = $request->price_products;
            $purchaseProducts = $request->purchase_products;
            $description_products = $request->description_products;
            $nameImages = $request->productsImage;
            $nameDB = '';

            if (!empty($nameImages)) {
                // lấy phần mở rộng của file image
                $extension = $nameImages->getClientOriginalExtension();

                // create name insert database
                $nameDB = date('Y-m-d-H-i-s') . '.' . $extension;

                //move image to folder image in public
                $nameImages->move(public_path('assets/clients/images/Products'), $nameDB);
            }

            $data = [
                'ID' => $id,
                'nameProduct' => $nameProducts,
                'quatity' => $quatityProducts,
                'priceProduct' => $priceProducts,
                'purchaseProduct' => $purchaseProducts,
                'URLImages' => $nameDB,
                'description' => $description_products
            ];
            $this->main->editProduct($id, $data);
            $msg = 'Sửa sản phẩm thành công';
        } else {
            $msg = 'Sửa sản phẩm không thành công';
        }

        $productlists = $this->main->getProducts();
        return view('main.products.getProducts', ['msg' => $msg, 'productlists' => $productlists]);
    }

    // get form delete
    public function getDeleteProducts(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $product = $this->main->getProductID($id)[0];
            if (!empty($product)) {
                $request->session()->put('id', $id);
            } else {
                return redirect()->back()->with('msg', 'Sản phẩm không tồn tại');
            }
        } else {
            return redirect()->back()->with('msg', 'Liên kết không tồn tại');
        }
        return view('main.products.deleteProduct', compact('product'));
    }

    // delete product
    public function deleteProduct()
    {
        $id = session('id');

        // delete product
        $this->main->deleteProduct($id);

        // get product list
        $productlists = $this->main->getProducts();
        return view('main.products.getProducts', ['msg' => 'Xóa sản phẩm thành công', 'productlists' => $productlists]);
    }

    // import file
    public function getimportFilePrduct()
    {
        return view('main.products.import');
    }

    public function importFilePrduct(Request $request)
    {
        if (!empty($request->file('inputFile_products'))) {
            Excel::Import(new ProductImport, $request->file('inputFile_products'));
        }
        return back();
    }

    // Download template
    public function downLoadTemplate()
    {
        $productlists = [
            'URLImages' => 'đường dẩn tới hình ảnh trên máy',
            'nameProduct' => 'tên sản phẩm',
            'quatity' => '10',
            'priceProduct' => '20000',
            'purchaseProduct' => '3000',
            'description' => 'Mô tả sản phẩm',
        ];
        return Excel::download(new template($productlists), '_Template_' . time() . '_.xlsx');
    }

    //export file
    public function exportFilePrduct()
    {
        $productlists = $this->main->getProducts();
        return Excel::download(new template($productlists), '_Export_' . time() . '_.xlsx');
    }

    //=========================================================
    // Get Customers list
    public function getCustomers()
    {
        $Customers = $this->main->getCustomers();
        $index = 1;
        return view('main.customers.getCustomers', compact('Customers', 'index'));
    }
    // Get form add Customer
    public function getAddCustomers()
    {
        return view('main.customers.getAddCustomers');
    }

    // Add Customer
    public function addCustomers(Request $request)
    {
        $request->validate(
            [
                'nameCustomer' => 'required',
                'phoneNumber' => 'required|unique:customers|max:10',
                'Address' => 'required',
                'city' => 'present',
                'district' => 'present',
                'ward' => 'present'
            ],
            [
                'nameCustomer.required' => 'Chưa nhập tên khách hàng',
                'phoneNumber.required' => 'Chưa nhập số điện thoại khách hàng',
                'phoneNumber.unique' => 'Số điện thoại đã tồn tại',
                'phoneNumber.max' => 'Số điện thoại không đúng định dạng',
                'Address.required' => 'Chưa nhập số nhà, tên đường',
                'city.present' => 'Chưa chọn tỉnh thành',
                'district.present' => 'Chưa chọn Quận/Huyện',
                'ward.present' => 'Chưa chọn Phường/Xã',
            ]
        );
        $json = file_get_contents('https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json');
        $obj = json_decode($json);
        $address = '';

        // get address
        foreach ($obj as $city) {
            if ($city->Id == $request->city) {
                $address = $address . ', ' . $city->Name;
                foreach ($city->Districts as $district) {
                    if ($district->Id == $request->district) {
                        $address = ', ' . $district->Name . $address;
                        foreach ($district->Wards as $wards) {
                            if ($wards->Id == $request->ward) {
                                $address = ', ' . $wards->Name . $address;
                            }
                        }
                    }
                }
            }
        }

        $phoneNumber = $request->phoneNumber;
        $nameCustomer = $request->nameCustomer;
        $address = $request->Address . $address;
        $this->main->addCustomers($nameCustomer, $phoneNumber, $address);
        $Customers = $this->main->getCustomers();
        $index = 1;
        return view('main.customers.getCustomers', ['msg' => 'Thêm khách hàng thành công', 'Customers' => $Customers, 'index'=>$index]);
    }

    // get edit customer
    public function getEditCustomers(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $Customer = $this->main->getCustomerID($id)[0];
            if (!empty($Customer)) {
                $request->session()->put('id', $id);
            } else {
                return back()->with('msg', 'Khách hàng không tồn tại');
            }
        } else {
            return back()->with('msg', 'Không tồn tại liên kết khách hàng');
        }
        $address = explode(',', $Customer->Address);
        return view('main.customers.editCustomer', compact('Customer', 'address'));
    }

    public function editCustomer(Request $request)
    {
        $id = session('id');
        if (!empty($id)) {
            $request->validate(
                [
                    'nameCustomer' => 'required',
                    'phoneNumber' => 'required|max:10',
                    'Address' => 'required',
                ],
                [
                    'nameCustomer.required' => 'Chưa nhập tên khách hàng',
                    'phoneNumber.required' => 'Chưa nhập số điện thoại khách hàng',
                    'phoneNumber.unique' => 'Số điện thoại đã tồn tại',
                    'phoneNumber.max' => 'Số điện thoại không đúng định dạng',
                    'Address.required' => 'Chưa nhập số nhà, tên đường',
                ]
            );

            $data = [
                'ID' => $id,
                'nameCustomer' => $request->nameCustomer,
                'phoneNumber' => $request->phoneNumber,
                'Address' => $request->Address
            ];
            // dd($id, $data);

            $this->main->editCustomer($id, $data);
            $msg = 'Sửa sản phẩm thành công';
        } else {
            $msg = 'Sửa sản phẩm không thành công';
        }
        $Customers = $this->main->getCustomers();
        $index = 1;
        return view('main.customers.getCustomers', ['msg' => $msg, 'Customers' => $Customers, 'index' => $index]);
    }
    //=================================
    // Orders
    public function getOrders()
    {
        $Transactions = $this->main->getTransactions();
        return view('main.orders.getOrders', compact('Transactions'));
    }

    // get form add order
    public function getAddOrders(Request  $request)
    {
        $Customers = $this->main->getCustomers();
        $Products = $this->main->getProducts();
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
                    $detail = $this->main->getProductName($product);
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
            $this->main->insertTransaction($dataTransaction);


            // insert order
            $TransactionID = $this->main->getIDmax();
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
                    $this->main->insertOrders($dataOrder);
                    $msg = "Tạo đơn hàng thành công";
                }
            } else {
                $msgErr = "Chưa thêm sản phẩm";
            }
        }

        // data show
        $Customers = $this->main->getCustomers();
        $Products = $this->main->getProducts();
        // dd($msg, $msgErr);
        return view('main.orders.getAddOrders', compact("Customers", "Products", "msg", "msgErr"));
    }

    // get order detail
    public function ordersDetail(Request $request)
    {
        $id = $request->id;
        $Transactions = $this->main->getTransactionsID($id)[0];
        $Customers = $this->main->getCustomerName($Transactions->Customers)[0];
        $Orders = $this->main->getOrderByIDTransaction($id);
        // dd($Orders);
        return view('main.orders.orderDetail', compact('Customers', 'Transactions', 'Orders'));
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
        $list_transactions = $this->main->getTransactionsByTime(7);

        // get detail One Day
        foreach ($date_array as $date) {
            $nextDay =date('Y-m-d H:i:s', strtotime('+1 day', strtotime($date)));
            $transactions = $this->main->getTransactionsOneDate($date, $nextDay);
            $RevenueOneDay = 0;
            $purchase = 0;
            // get detail One Day
            foreach ($transactions as $transaction) {
                // get total Revenue
                $RevenueOneDay += $transaction->TotalPayment - $transaction->Discount;
                // get total Purchase
                $orders = $this->main->getOrderByIDTransaction($transaction->ID);
                foreach ($orders as $order_) {
                    $product = $this->main->getProductName($order_->Products)[0];
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
