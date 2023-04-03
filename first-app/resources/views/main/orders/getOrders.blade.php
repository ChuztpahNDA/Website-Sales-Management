@extends('layouts.main')

@section('content')
    @if (!empty($msg))
        <div class="alert alert-success">{{ $msg }}</div>
    @endif
    <h1> Danh sách đơn hàng </h1>
    <div class="d-flex flex-row align-items-center mb-4 justify-content-end" style="margin-right: 1%">
        <a href="#" class="btn btn-primary" style="margin-left: 5px">Xuất excel</a>
    </div>
    <table id="myTable" class="table table-hover">
        <thead>
            <tr>
                <th style="width: 10%"> ID </th>
                <th style="width: 40%">Tên Khách Hàng</th>
                <th>Tổng thanh toán</th>
                <th>Giảm giá</th>
                <th>Thời gian tạo</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($Transactions))
                @foreach ($Transactions as $Transaction)
                    <tr>
                        <td>{{ $Transaction->ID }}</td>
                        <td><a style="text-decoration: none; color: black" href="{{route('getOrderDetail', ["id" => $Transaction->ID])}}">{{ $Transaction->Customers }}</a></td>
                        <td>{{ $Transaction->TotalPayment }}</td>
                        <td>{{ $Transaction->Discount }}</td>
                        <td>{{ $Transaction->created_at }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
