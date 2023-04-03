@extends('layouts.main')
@section('content')
    <h1 style="text-align: center; margin-bottom: 5%">Thông tin đơn hàng</h1>
    @if (!empty($Customers))
        <h4 style="margin-top: 20px; margin-bottom: 10px">Thông tin khách hàng</h4>
        <div class="d-flex flex-column">
            <div class="d-flex ">
                <strong style="margin-right: 5px; width: 200px">Tên khách hàng:</strong>
                <p>{{ $Customers->nameCustomer }}</p>
            </div>

            <div class="d-flex ">
                <strong style="margin-right: 5px; width: 200px">Địa chỉ:</strong>
                <p>{{ $Customers->Address }}</p>
            </div>

            <div class="d-flex ">
                <strong style="margin-right: 5px; width: 200px">Số điện thoại:</strong>
                <p>{{ $Customers->phoneNumber }}</p>
            </div>
        </div>
    @endif
    <hr>
    <div>
        <h4>Danh sách sản phẩm</h4>
        @if (!empty($Orders))
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tên Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá bán</th>
                        <th>Thành tiền</th>

                    </tr>
                </thead>
                @foreach ($Orders as $order)
                    <tbody>
                        <tr>
                            <td style="width: 40%">{{ $order->Products }}</td>
                            <td style="width: 10%"> {{ $order->quatity_Products }}</td>
                            <td style="width: 25%">{{ $order->Payment }}</td>
                            <td style="width: 25%">{{ $order->Payment * $order->quatity_Products }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        @endif
    </div>
    <hr>
    @if (!empty($Transactions))
        <h4 style="margin-top: 20px; margin-bottom: 10px">Thông tin thanh toán</h4>
        <div class="d-flex flex-column ">
            <div class="d-flex ">
                <strong style="margin-right: 5px; width: 100px">Tổng tiền</strong>
                <p>{{ $Transactions->TotalPayment + $Transactions->Discount }}</p>
            </div>

            <div class="d-flex">
                <strong style="margin-right: 5px; width: 100px">Chiết khấu</strong>
                <p>{{ $Transactions->Discount }}</p>
            </div>

            <div class="d-flex">
                <strong style="margin-right: 5px; width: 100px">Thanh toán</strong>
                <p>{{ $Transactions->TotalPayment }}</p>
            </div>
        </div>
    @endif
    <div class="d-flex justify-content-end" style="margin-right: 20px">
        <button class="btn btn-primary" style="margin-right: 5px" onclick="edit">Chỉnh sửa đơn hàng</button>
        <a class="btn btn-success" href="{{route('getOrders')}}">Quay lại</a>
    </div>
@endsection
