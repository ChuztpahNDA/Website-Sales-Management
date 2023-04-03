@extends('layouts.main')
@section('content')
    <div class="row" style="height: 600px;">
        <h2> Tạo đơn hàng </h2>

        {{-- Success --}}
        @if (!@empty($msg))
            @if ($msg != ' ')
                <div class="alert alert-success w-50">{{ $msg }}</div>
            @endif
        @endif

        {{-- Error --}}
        @if (!empty($msgErr))
            @if ($msgErr != ' ')
                <div class="alert alert-danger w-50">{{ $msgErr }}</div>
            @endif
        @endif

        {{-- Customer Detail --}}
        <form action="{{ route('getAddOrders') }}" method="POST" enctype="multipart/form-data" id="form_order">
            @csrf
            <div class="border border-3 col-12 h50 p-3">
                <h4>Thông tin khách hàng</h4>
                <div id="selectCustomer">
                    <p style="margin-left: 5px">Chọn khách hàng</p>
                    <select class="form-select w-50" id="CustomerDetail" name="Customer_detail">
                        @if (!empty($Customers))
                            <option selected>Thêm khách hàng mới</option>
                            @foreach ($Customers as $Customer)
                                <option
                                    value="{{ $Customer->nameCustomer . '-' . $Customer->phoneNumber . '-' . $Customer->Address . '-' . $Customer->ID }}"
                                    onclick="showCustomer()">{{ $Customer->nameCustomer }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div id="showCustomer" style="display: none">
                    <strong id="name-phone"></strong>
                    <a onclick="showCustomer()" type="button" style="margin-left: 10px"><i class="fa fa-refresh"
                            aria-hidden="true"></i></a>
                    <hr>
                    <p><strong>Địa chỉ giao hàng</strong> <a href="{{ route('editCustomers') }}" id="editCustomer"
                            target="_blank" style="text-decoration: none;">Thay đổi</a></p>
                    <p id="phone"></p>
                    <p id="address"></p>
                </div>
            </div>

            {{-- Product Detail --}}
            <div class="col-12 h50 border border-3 p-3" style="margin-top: 10px">
                <h4>Thông tin sản phẩm</h4>
                <p style="margin-left: 5px">Chọn sản phẩm</p>
                <select class="form-select w-50" id="ProductDetail">
                    @if (!empty($Products))
                        <option selected>Thêm sản phẩm mới</option>
                        @foreach ($Products as $Product)
                            <option value="{{ $Product->ID . '-' . $Product->nameProduct . '-' . $Product->priceProduct }}"
                                onclick="addProduct()">{{ $Product->nameProduct }}</option>
                        @endforeach
                    @endif
                </select>
                <table class="table" style="margin-top: 5px" name="Product_detail">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá bán</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody id="entries">
                    </tbody>
                </table>
            </div>

            {{-- Payment --}}
            <div id="payment" class="d-flex justify-content-end p-2">
                <div style="width: 400px; display: flex; flex-direction: column">
                    <div style="display: flex; flex-direction: row; margin-bottom: 10px">
                        <strong style="margin-right: 10px; width: 25%">Tổng tiền</strong>
                        <input id="total" autocomplete="off" value="0" disabled
                            style="width: 70%; text-align: right; border: none; border-bottom: 1px dotted rgb(105, 105, 105)">
                    </div>
                    <div style="display: flex; flex-direction: row; margin-bottom: 10px">
                        <strong style="margin-right: 10px; width: 25%;">Chiết khấu</strong>
                        <input id="discount" type="text" value="0" autocomplete="off" name="discount"
                            style="width: 70%; text-align: right; border: none; border-bottom: 1px dotted rgb(105, 105, 105)">
                    </div>

                    <div style="display: flex; flex-direction: row; margin-bottom: 10px">
                        <strong style="margin-right: 10px; width: 25%">Thanh toán</strong>
                        <input id="total_price" autocomplete="off" disabled value="0"
                            style="width: 70%; text-align: right; border: none; border-bottom: 1px dotted rgb(105, 105, 105)">
                    </div>
                    @error('payment')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <input type="hidden" name="ProductListID" id="ProductListID" autocomplete="off">
        </form>

        {{-- button create order --}}
        <div class="d-flex mb-3 mb-lg-4 justify-content-end">
            <button class="btn btn-primary btn-lg" onclick='document.getElementById("form_order").submit()'>Tạo
                đơn hàng</button>
        </div>

        <Script>
            const textTotalPriceProduct = {};
            const listQuatity = {};
            let totalPrice = 0;
        </Script>
    </div>
@endsection
