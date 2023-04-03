@extends('layouts.main')

@section('content')
    <form class="mx-1 mx-md-4" action="{{ route('importfileProducts') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <h1>Thêm sản phẩm bằng file excel</h1>
            <div style="margin: 10px">
                @if ($errors->any())
                    <h3 style="color: red">Trong file excel có các lỗi sau:</h3>
                    @foreach ($errors->all() as $err)
                        <li style="list-style-type: none">
                            {{ 'Hàng ' . filter_var(explode('.', $err)[0], FILTER_SANITIZE_NUMBER_INT) . ': ' . explode('.', $err)[1] }}
                        </li>
                    @endforeach
                    <hr>
                @endif
            </div>
            <span style="margin-bottom: 10px">Tải file mẫu <a href="{{route('Template')}}" role="button">tại đây</a> </span>
            <div class="d-flex flex-row align-items-center mb-4">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="">Nhập file excel</label>
                    <input class="form-control" type="file" name="inputFile_products" accept="xlsx, xls">
                </div>
            </div>
            {{-- button create products --}}
            <div class="d-flex mb-3 mb-lg-4">
                <button type="submit" class="btn btn-primary btn-lg">Tạo sản phẩm</button>
            </div>
    </form>
@endsection
