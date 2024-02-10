@extends('layouts.admin')

@section('content')
<div class="body">
    <div class="title-section clearfix">
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-4">
                                <div class="shap">
                                    <img src="{{ asset('backend/images/icon/people.png') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="">
                                <h1 class="card-title mb-2">{{$user_number}}</h1>
                                <p class="text-uppercase m-0">Users</p>
                            </div>

                            <a href="{{ route('customers') }}"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" class="img-eye icon-rounded" alt=""></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-4">
                                <div class="shap"><img src="{{ asset('backend/images/icon/icon-shirt.png') }}" class="img-fluid" alt=""></div>
                            </div>
                            <div class="">
                                <h1 class="card-title mb-2">{{$product_number}}</h1>
                                <p class="text-uppercase m-0">Total Product</p>
                            </div>

                            <a href="{{ route('all_products') }}"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" class="img-eye icon-rounded" alt=""></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-4">
                                <div class="shap"><img src="{{ asset('backend/images/icon/icon-order.svg') }}" class="img-fluid" alt=""></div>
                            </div>
                            <div class="">
                                <h1 class="card-title mb-2">{{$order_number}}</h1>
                                <p class="text-uppercase m-0">Total Order</p>
                            </div>

                            <a href="{{ route('all_order') }}"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" class="img-eye icon-rounded" alt=""></a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">
                    Order Statistics <?=date('Y')?>
                    </h2>

                    <canvas id="myChart" width="400" height="90"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@stop
@push('scripts')      
<script>
make_statistics_chart();

function make_statistics_chart(){
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('chart_data') }}",
        method: 'POST',
        data: {_token: _token},
        success: function (data) {
            console.log(data);
            var month_array = ['01','02','03','04','05','06','07','08','09','10','11','12'];
            var order_num = data.order_num;
            var order_data = data.order_data;

            var order_month_arr = [];
            var total_order_arr = [];
            for(var j=0; j<order_data.length; j++){
                var single_order = order_data[j];
                var order_month = single_order.order_month;
                var total_order = single_order.total_order;

                order_month_arr.push(order_month);
                total_order_arr.push(total_order);
            }

            var order_data_arr = [];

            for(var m=0; m<=11; m++){
                var month = month_array[m];
                if($.inArray(month, order_month_arr) != -1){
                    var index = order_month_arr.indexOf(month);
                    var order_num = total_order_arr[index];
                    order_data_arr.push(order_num);
                }else{
                    order_data_arr.push('0');
                }
            }

            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
            type: 'line',
            data:{
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                datasets: [
                {
                    label: "Total Orders "+order_num+"",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(70,191,189,1)",
                    pointColor: "rgba(70,191,189,1)",
                    pointStrokeColor: "rgba(70,191,189,1)",
                    backgroundColor: "rgba(116, 89, 217, 0.1)",
                    borderColor: "rgba(70,191,189,1)",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: order_data_arr,
                }]
            },
            options: {
            layout: {
                padding: 10,
            },
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Precipitation in Toronto'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: false,
                            labelString: 'Precipitation in mm'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: false,
                            labelString: 'Month of the Year'
                        }
                    }]
                }
            }
            });
        }
    });
}
</script>
@endpush 