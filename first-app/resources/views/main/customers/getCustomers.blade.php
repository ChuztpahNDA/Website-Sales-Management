@extends('layouts.main')

@section('content')
    @if (!empty($msg))
        <div class="alert alert-success">{{ $msg }}</div>
    @endif
    <h1>Danh sách khách hàng</h1>
    <table id="myTable" class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Khách Hàng</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($Customers))
                @foreach ($Customers as $Customer)
                    <tr>
                        <td>{{ $index++ }}</td>
                        <td>{{ $Customer->nameCustomer }}</td>
                        <td>{{ $Customer->phoneNumber }}</td>
                        <td>{{ $Customer->Address }}</td>
                        <td><a class="btn btn-outline-warning"
                                href="{{ route('editCustomers', ['id' => $Customer->ID]) }}">Sửa</a></td>
                        <td><a class="btn btn-outline-danger"
                                href="{{ route('deleteCustomers', ['id' => $Customer->ID]) }}">Xóa</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
