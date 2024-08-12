@extends('layouts.main')
@section('page_title')
Trang chủ
@endsection

@section('title')
Admin Panel - {{ $config->web_title }}
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/morrisjs/morris.css') }}">
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
{{--<div class="row">--}}
{{--    <div class="col-lg-3 col-6">--}}
{{--        <!-- small box -->--}}
{{--        <div class="small-box bg-info">--}}
{{--            <div class="inner">--}}
{{--                <h3 style="color: #F58220">{{ $data['orders'] }}</h3>--}}
{{--                <p>Tổng số đơn trong ngày</p>--}}
{{--            </div>--}}
{{--            <div class="icon">--}}
{{--                <i class="fas fa-file-invoice"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- ./col -->--}}
{{--    <div class="col-lg-3 col-6">--}}
{{--        <!-- small box -->--}}
{{--        <div class="small-box bg-success">--}}
{{--            <div class="inner">--}}
{{--                <h3 style="color: #F58220">{{ formatCurrent($data['total_price']) }}</h3>--}}
{{--                <p>Giá trị đặt hàng trong ngày</p>--}}
{{--            </div>--}}
{{--            <div class="icon">--}}
{{--                <i class="fas fa-file-invoice-dollar"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- ./col -->--}}
{{--    <div class="col-lg-3 col-6">--}}
{{--        <!-- small box -->--}}
{{--        <div class="small-box bg-warning">--}}
{{--            <div class="inner">--}}
{{--                <h3 style="color: #F58220">{{ $data_analytics['active'] }}</h3>--}}
{{--                <p>Khách đang online</p>--}}
{{--            </div>--}}
{{--            <div class="icon">--}}
{{--                <i class="fas fa-user"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- ./col -->--}}
{{--    <div class="col-lg-3 col-6">--}}
{{--        <!-- small box -->--}}
{{--        <div class="small-box bg-danger">--}}
{{--            <div class="inner">--}}
{{--                <h3 style="color: #F58220">{{ isset($data_analytics['today']) ? $data_analytics['today'][0]['visitors'] : 0 }}</h3>--}}
{{--                <p> Khách trong ngày </p>--}}
{{--            </div>--}}
{{--            <div class="icon">--}}
{{--                <i class="fas fa-users"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- ./col -->--}}
{{--</div>--}}
{{--<!-- /.row -->--}}
{{--<!-- Main row -->--}}
{{--<div class="row">--}}
{{--    <section class="col-lg-12 connectedSortable">--}}
{{--        <!-- BAR CHART -->--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title">Biểu đồ doanh số đặt hàng 10 ngày gần nhất</h3>--}}

{{--                <div class="card-tools">--}}
{{--                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
{{--                    </button>--}}
{{--                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="chart">--}}
{{--                    <canvas id="barChart" style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /.card-body -->--}}
{{--        </div>--}}
{{--        <!-- /.card -->--}}
{{--    </section>--}}
{{--    <section class="col-lg-6 connectedSortable">--}}
{{--        <!-- TO DO List -->--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title">--}}
{{--                    <i class="ion ion-clipboard mr-1"></i>--}}
{{--                    Số lượt truy cập theo ngày--}}
{{--                </h3>--}}
{{--            </div>--}}
{{--            <!-- /.card-header -->--}}
{{--            <div class="card-body">--}}
{{--                <div id="area-chart"></div>--}}

{{--            </div>--}}
{{--            <!-- /.card-body -->--}}
{{--        </div>--}}
{{--        <!-- /.card -->--}}
{{--    </section>--}}

{{--    <section class="col-lg-6 connectedSortable">--}}
{{--        <!-- TO DO List -->--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title">--}}
{{--                    <i class="ion ion-clipboard mr-1"></i>--}}
{{--                    Nguồn truy cập (30 ngày gần nhất)--}}
{{--                </h3>--}}
{{--            </div>--}}
{{--            <!-- /.card-header -->--}}
{{--            <div class="card-body">--}}
{{--                <div id="organic-chart"></div>--}}

{{--            </div>--}}
{{--            <!-- /.card-body -->--}}
{{--        </div>--}}
{{--        <!-- /.card -->--}}
{{--    </section>--}}

{{--</div>--}}

{{--<div class="row">--}}

{{--    <section class="col-lg-4 connectedSortable">--}}
{{--        <!-- TO DO List -->--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title">--}}
{{--                    <i class="ion ion-clipboard mr-1"></i>--}}
{{--                    Thiết bị truy cập 30 ngày qua--}}
{{--                </h3>--}}
{{--            </div>--}}
{{--            <!-- /.card-header -->--}}
{{--            <div class="card-body">--}}
{{--                <div id="devices-chart"></div>--}}
{{--                <table style="padding: 7px; text-align: center;width: 100%">--}}
{{--                    <tr>--}}
{{--                        <td>Máy tính để bàn</td>--}}
{{--                        <td>Di động</td>--}}
{{--                        <td>Máy tính bảng</td>--}}
{{--                    </tr>--}}
{{--                    @if(!$data_analytics['devices']->isEmpty())--}}
{{--                    <tr>--}}
{{--                        <td style="font-weight: bold;">--}}

{{--                            @if(isset($data_analytics['devices'][0]))--}}
{{--                            {{ round(($data_analytics['devices'][0]['count']/$data_analytics['devices']->sum('count'))*100, 2) }} %--}}
{{--                            @else--}}
{{--                            0 %--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                        <td style="font-weight: bold;">--}}
{{--                            @if(isset($data_analytics['devices'][1]))--}}
{{--                            {{ round(($data_analytics['devices'][1]['count']/$data_analytics['devices']->sum('count'))*100, 2) }} %--}}
{{--                            @else--}}
{{--                            0 %--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                        <td style="font-weight: bold;">--}}
{{--                            @if(isset($data_analytics['devices'][2]))--}}
{{--                            {{ round(($data_analytics['devices'][2]['count']/$data_analytics['devices']->sum('count'))*100, 2) }} %--}}
{{--                            @else--}}
{{--                            0 %--}}
{{--                            @endif--}}
{{--                        </td>--}}

{{--                    </tr>--}}
{{--                    @endif--}}
{{--                </table>--}}
{{--            </div>--}}
{{--            <!-- /.card-body -->--}}
{{--        </div>--}}
{{--        <!-- /.card -->--}}
{{--    </section>--}}

{{--    <section class="col-lg-8 connectedSortable">--}}
{{--        <!-- TO DO List -->--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title">--}}
{{--                    <i class="ion ion-clipboard mr-1"></i>--}}
{{--                    Thiết bị truy cập 30 ngày qua--}}
{{--                </h3>--}}
{{--            </div>--}}
{{--            <!-- /.card-header -->--}}
{{--            <div class="card-body">--}}
{{--                <table class="table table-condensed table-hover">--}}
{{--                    <thead>--}}
{{--                        <tr>--}}
{{--                            <th>URL</th>--}}
{{--                            <th>Tên trang</th>--}}
{{--                            <th>Số lần xem</th>--}}
{{--                        </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                        @foreach ($data_analytics['top_visited_pages'] as $item)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $item['url'] }}</td>--}}
{{--                            <td>{{ $item['pageTitle'] }}</td>--}}
{{--                            <td>{{ $item['pageViews'] }}</td>--}}
{{--                        </tr>--}}
{{--                        @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--            <!-- /.card-body -->--}}
{{--        </div>--}}
{{--        <!-- /.card -->--}}
{{--    </section>--}}


{{--</div>--}}

<!-- /.row (main row) -->
@endsection
@section('script')
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ URL('plugins/countjs/count.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('plugins/morrisjs/morris.js') }}"></script>





@endsection
