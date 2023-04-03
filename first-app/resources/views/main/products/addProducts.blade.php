@extends('layouts.main')

@section('content')
    <form class="mx-1 mx-md-4" action="{{ route('addProducts') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="d-flex flex-row align-items-center mb-4 col-7">
                <h2>Thêm sản phẩm</h2>
            </div>

            <div class="d-flex flex-row align-items-center mb-4 col-4 justify-content-end">
                <a href="{{ route('importfileProducts') }}" class="btn btn-primary">Nhập excel</a>
            </div>

            <div class="col-11">
                @if (!empty($message))
                    <div class="alert alert-success">{{ $message }}</div>
                @endif
            </div>

            <div class="col-5">

                <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="">Tên sản phẩm</label>
                        <input class="form-control" type="text" name="name_products">
                        @error('name_products')
                            <span style="color: red"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <div class="form-outline flex-fill mb-4">
                        <label class="form-label" for="">Số lượng</label>
                        <input class="form-control" type="number" name="quantity_products">
                        @error('quantity_products')
                            <span style="color: red"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="">Giá nhập</label>
                        <input class="form-control" type="text" name="purchase_products">
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="">giá bán</label>
                        <input class="form-control" type="text" name="price_products">
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
                    <textarea class="form-control" type="text" name="description_products" rows="16" cols="20"></textarea>
                    @error('description_products')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- button create products --}}
        <div class="d-flex mb-3 mb-lg-4">
            <button type="submit" class="btn btn-primary btn-lg" name="btnAddProducts">Tạo sản phẩm</button>
        </div>
    </form>
@endsection
