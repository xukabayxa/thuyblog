@extends('layouts.main')

@section('css')
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
          rel="stylesheet"/>
@endsection

@section('page_title')
    Quản lý lớp học
@endsection

@section('title')
    Quản lý lớp học
@endsection

@section('content')
    <div ng-cloak>
        <div class="row" ng-controller="Courses">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table-list">
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript"
            src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

    <script>
        let datatable = new DATATABLE('table-list', {
            ajax: {
                url: '{!! route('Courses.searchData') !!}',
                data: function (d, context) {
                    DATATABLE.mergeSearch(d, context);
                }
            },
            columns: [
                {data: 'id', orderable: false},
                {data: 'DT_RowIndex', orderable: false, title: "STT", className: "text-center"},
                {data: 'title', title: 'Lớp học'},
                {data: 'age', title: 'Độ tuổi'},
                {data: 'schedule', title: 'Thời gian học'},
                {data: 'created_by', title: 'Người lập'},
                {data: 'updated_by', title: 'Người cập nhật'},
                {
                    data: 'status',
                    title: "Trạng thái",
                    render: function (data) {
                        if (data == 0) {
                            return `<span class="badge badge-danger">Khóa</span>`;
                        } else {
                            return `<span class="badge badge-success">Hoạt động</span>`;
                        }
                    }
                },
                {data: 'action', orderable: false, title: "Hành động", className: "text-center"}
            ],
            search_columns: [
                {data: 'title', search_type: "text", placeholder: "Tên lớp học"},
                {data: 'age', search_type: "text", placeholder: "Độ tuổi"},
                {
                    data: 'status', search_type: "select", placeholder: "Trạng thái",
                    column_data: [{id: 1, name: "Hoạt động"}, {id: -1, name: "Khóa"}]
                },
            ],
            @if(Auth::user()->type == App\Model\Common\User::SUPER_ADMIN || Auth::user()->type == App\Model\Common\User::QUAN_TRI_VIEN)
            create_link: "{{ route('Courses.create') }}"
            @endif
        }).datatable;

        app.controller('Courses', function ($scope, $rootScope, $http) {
            $scope.loading = {};
            $scope.arrayInclude = arrayInclude;
        })


    </script>
    @include('partial.confirm')
@endsection
