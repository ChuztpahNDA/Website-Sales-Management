<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductImport;
use App\Exports\template;
use App\Models\products;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Products_repository;

class ProductController extends Controller
{

    private $Products_DB;

    public function __construct()
    {
        $this->Products_DB = new Products_repository();
    }

    // get Products list
    public function getProducts()
    {
        $productlists = $this->Products_DB->getProducts();
        $STT = 1;
        return view('main.products.getProducts', ['STT' => $STT, 'productlists' => $productlists]);
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
                "name_products" => 'required|unique:products,nameProduct',
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
        $created_at = date('Y-m-d H:i:s');
        $nameDB = '';
        if (!empty($nameImages)) {
            // lấy phần mở rộng của file image
            $extension = $nameImages->getClientOriginalExtension();

            // create name insert database
            $nameDB =  $nameProducts . '.' . $extension;

            //move image to folder image in public
            $nameImages->move(public_path('assets/clients/images/Products'), $nameDB);
        }

        $data = [
            'nameProduct' => $nameProducts,
            'quatity' => $quatityProducts,
            'priceProduct' => $priceProducts,
            'purchaseProduct' => $purchaseProducts,
            'URLImages' => $nameDB,
            'description' => $description_products,
            'created_at' => $created_at,
            'updated_at' => $created_at
        ];
        $this->Products_DB->addProducts($data);

        return view('main.products.addProducts', ['message' => 'Thêm sản phẩm thành công']);
    }


    //  get form edit Product
    public function getEditProducts(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $product = $this->Products_DB->getProductID($id)[0];
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
                'description' => $description_products,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->Products_DB->editProduct($id, $data);
            $msg = 'Sửa sản phẩm thành công';
        } else {
            $msg = 'Sửa sản phẩm không thành công';
        }

        $productlists = $this->Products_DB->getProducts();
        $STT = 1;
        return view('main.products.getProducts', ['STT' => $STT, 'msg' => $msg, 'productlists' => $productlists]);
    }

    // get form delete
    public function getDeleteProducts(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $product = $this->Products_DB->getProductID($id)[0];
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
        $this->Products_DB->deleteProduct($id);

        // get product list
        $productlists = $this->Products_DB->getProducts();
        $STT = 1;
        return view('main.products.getProducts', ['STT' => $STT, 'msg' => 'Xóa sản phẩm thành công', 'productlists' => $productlists]);
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
        $productlists = $this->Products_DB->getProducts();
        $STT = 1;
        return view('main.products.getProducts', ['STT' => $STT, 'message' => 'Thêm sản phẩm thành công', 'productlists' => $productlists]);
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
        $productlists = $this->Products_DB->getProducts();
        return Excel::download(new template($productlists), '_Export_' . time() . '_.xlsx');
    }
}
