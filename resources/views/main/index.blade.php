@extends('layouts.main')

{{-- content main --}}
@section('content')
    <div>
        <h4 style="margin-bottom: 30px">KẾT QUẢ KINH DOANH TRONG NGÀY</h4>
        <hr>
        @if (!empty($dataOneDay))
            <div class="d-flex justify-content-start" style="background-color:rgb(232, 241, 250)">
                <div class="block_">
                    <span class="fa fa-archive iconGreen" aria-hidden="true" style="font-size: 3.5em; margin: 7px"></span>
                    <div class="block_content">
                        <strong>Số đơn hàng</strong>
                        <span style="color:  green"></span>{{ $dataOneDay['totalTransactionOnedays'] }}</span>
                    </div>
                </div>

                <div class="block_">
                    <span class="fa fa-money iconBlue" style="font-size: 3.5em; margin: 7px"></span>
                    <div class="block_content">
                        <strong>Doanh thu</strong>
                        <span style="color: blue">{{ $dataOneDay['totalRevenueOneDay'] }}</span>
                    </div>

                </div>

                <div class="block_">
                    <span class="fa fa-cart-plus iconTomamto" aria-hidden="true"
                        style="font-size: 3.5em; margin: 7px"></span>

                    <div class="block_content">
                        <strong>Lợi nhận</strong>
                        <span style="color: tomato">{{ $dataOneDay['totalBenefitOneDay'] }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- show list transaction --}}
    <div style="margin-top: 25px">
        <table id="myTable" class="table table-hover">
            <thead style="background-color: rgb(253, 217, 210);">
                <tr>
                    <th>STT</th>
                    <th>Danh sách Sản Phẩm</th>
                    <th>Doanh thu</th>
                    <th>Ngày bán</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($transactionOnedays))
                    @foreach ($transactionOnedays as $transaction)
                        <tr>
                            <td>{{ $STT++ }}</td>
                            <td>{{ $transaction->Customers }}</td>
                            <td>{{ $transaction->TotalPayment - $transaction->Discount }}</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
    </div>

@endsection
