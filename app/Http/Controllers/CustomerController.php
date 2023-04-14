<?php

namespace App\Http\Controllers;

use App\Models\Customers_repository;
use Illuminate\Http\Request;


class CustomerController extends Controller
{

    private $Customers_DB;
    public function __construct()
    {
        $this->Customers_DB = new Customers_repository();
    }

    //=========================================================
    // Get Customers list
    public function getCustomers()
    {
        $Customers = $this->Customers_DB->getCustomers();
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
        $this->Customers_DB->addCustomers($nameCustomer, $phoneNumber, $address);
        $Customers = $this->Customers_DB->getCustomers();
        $index = 1;
        return view('main.customers.getCustomers', ['msg' => 'Thêm khách hàng thành công', 'Customers' => $Customers, 'index' => $index]);
    }

    // get edit customer
    public function getEditCustomers(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $Customer = $this->Customers_DB->getCustomerID($id)[0];
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

            $this->Customers_DB->editCustomer($id, $data);
            $msg = 'Sửa sản phẩm thành công';
        } else {
            $msg = 'Sửa sản phẩm không thành công';
        }
        $Customers = $this->Customers_DB->getCustomers();
        $index = 1;
        return view('main.customers.getCustomers', ['msg' => $msg, 'Customers' => $Customers, 'index' => $index]);
    }
}
