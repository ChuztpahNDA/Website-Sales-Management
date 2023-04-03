@extends('layouts.main')
@section('content')
    <div class="row">
        <h2>Sửa thông tin khách hàng</h2>
        @if (!empty($msg))
            <div class="alert alert-success">{{ $msg }}</div>
        @endif
        <form action="{{route('editCustomers')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="justify-content-center ">
                <div class="d-flex flex-row align-items-center mb-4 w-50">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="">Tên khách hàng</label>
                        <input class="form-control" type="text" name="nameCustomer" value="{{old('nameCustomer') ?? $Customer->nameCustomer}}">
                        @error('nameCustomer')
                            <span style="color: red"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mb-4 w-50">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="">Số điện thoại</label>
                        <input class="form-control" type="tel" name="phoneNumber" value="{{old('phoneNumber') ?? $Customer->phoneNumber}}">
                        @error('phoneNumber')
                            <span style="color: red"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mb-4 w-50">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="">Địa chỉ</label>
                        <input class="form-control" type="text" name="Address" value="{{old('Address') ?? $Customer->Address}}">
                        @error('Address')
                            <span style="color: red"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- button create customers --}}
            <div class="d-flex mb-3 mb-lg-4">
                <button type="submit" class="btn btn-primary btn-lg">Sửa khách hàng</button>
            </div>
        </form>
    </div>
@endsection
