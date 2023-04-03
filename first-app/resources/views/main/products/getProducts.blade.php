@extends('layouts.main')

@section('content')
    @if (!empty($msg))
        <div class="alert alert-success">{{ $msg }}</div>
    @endif
    <h1>Danh sách sản phẩm</h1>
    <div class="d-flex flex-row align-items-center mb-4 justify-content-end" style="margin-right: 2%">
        <a href="{{ route('exportfileProducts') }}" class="btn btn-primary" style="margin-left: 5px">Xuất excel</a>
    </div>
    <table id="myTable" class="table">
        <thead>
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Hình Ảnh</th>
                <th>Giá bán</th>
                <th style="width: 5%">Sửa</th>
                <th style="width: 5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($productlists))
                @foreach ($productlists as $product)
                    <tr>
                        <td>{{ $product->nameProduct }}</td>
                        <td>{{ $product->quatity }}</td>
                        <td><input type="image" alt="img"
                                src="{{ asset('assets/clients/images/Products/' . $product->URLImages) }}" width="48"
                                height="48"></td>
                        <td>{{ $product->priceProduct }}</td>
                        <td><a class="btn btn-outline-warning"
                                href="{{ route('editProducts', ['id' => $product->ID]) }}">Sửa</a></td>
                        <td><a class="btn btn-outline-danger"
                                href="{{ route('deleteProducts', ['id' => $product->ID]) }}">Xóa</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
