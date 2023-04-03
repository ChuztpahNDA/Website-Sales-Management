@extends('layouts.main')

@section('content')
    <form class="mx-1 mx-md-4" action="{{ route('post-delete') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="d-flex flex-row align-items-center mb-4">
                <h2>Sửa sản phẩm</h2>
            </div>

            <div class="col-5">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="">Tên sản phẩm</label>
                        <input class="form-control" type="text" name="name_products"
                            value="{{ old('name_products') ?? $product->nameProduct }}">
                        @error('name_products')
                            <span style="color: red"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <div class="form-outline flex-fill mb-4">
                        <label class="form-label" for="">Số lượng</label>
                        <input class="form-control" type="number" name="quantity_products"
                            value="{{ old('quantity_products') ?? $product->quatity }}">
                        @error('quantity_products')
                            <span style="color: red"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="">Giá nhập</label>
                        <input class="form-control" type="text" name="purchase_products"
                            value="{{ old('purchase_products') ?? $product->purchaseProduct }}">
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="">giá bán</label>
                        <input class="form-control" type="text" name="price_products"
                            value="{{ old('price_products') ?? $product->priceProduct }}">
                    </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="">Hình ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="productsImage">
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="">Mô tả sản phẩm</label>
                    <textarea class="form-control" type="text" name="description_products" rows="16" cols="20"
                        >{{old('description_products') ?? $product->description }}</textarea>
                </div>
            </div>
        </div>

        {{-- button create products --}}
        <div class="d-flex mb-3 mb-lg-4">
            <button type="submit" class="btn btn-primary btn-lg" style="margin-right: 5px">Xác nhận xóa sản phẩm</button>
            <a href="{{route('getProducts')}}" class="btn btn-warning btn-lg">Quay lại</a>
        </div>
    </form>
@endsection
