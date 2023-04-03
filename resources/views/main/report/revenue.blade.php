@extends('layouts.main')


@section('content')
    <div>
        <h4 style="margin-bottom: 30px">KẾT QUẢ KINH DOANH</h4>
        <hr>
        @if (!empty($data))
            <div class="d-flex justify-content-start" style="background-color:rgb(232, 241, 250)">
                <div class="block_">
                    <span class="fa fa-money iconBlue" style="font-size: 3.5em; margin: 7px"></span>
                    <div class="block_content">
                        <strong>Doanh thu</strong>
                        <span style="color: blue">{{ $data['sum_Revenues'] }}</span>
                    </div>

                </div>

                <div class="block_">
                    <span class="fa fa-cart-plus iconTomamto" aria-hidden="true"
                        style="font-size: 3.5em; margin: 7px"></span>

                    <div class="block_content">
                        <strong>Lợi nhận</strong>
                        <span style="color: tomato">{{ $data['sum_Benefits'] }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="block_content" style="margin-top: 30px; background-color:rgb(232, 241, 250)">
        <div class="d-flex justify-content-start" style="height: 50px">
            <select name="" id="" style="border: none; margin-left: 25px; background-color:rgb(232, 241, 250)">
                <option value="">Hôm nay</option>
                <option value="" selected>7 ngày qua</option>
                <option value="">1 tháng qua</option>
                <option value="">3 thàng qua</option>
            </select>
        </div>
        <div style="margin-top: 50px">
            <canvas id="barChart"></canvas>
        </div>
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
                @if (!empty($list_transactions))
                    @foreach ($list_transactions as $transaction)
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

    <script>
        //bar
        var ctxB = document.getElementById("barChart").getContext('2d');
        const myBarChart = new Chart(ctxB, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                        label: 'Doanh Thu',
                        data: <?php echo json_encode($list_Revenues); ?>,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1,
                        order: 0
                    },
                    {
                        label: 'Lợi Nhuận',
                        data: <?php echo json_encode($list_Benefits); ?>,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,
                        type: 'line',
                        order: 1
                    }
                ]
            },

            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
