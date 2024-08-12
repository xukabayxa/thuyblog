@extends('layouts.main')

@section('css')
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
          rel="stylesheet"/>
@endsection

@section('page_title')
    Quản lý giáo viên
@endsection

@section('title')
    Quản lý giáo viên
@endsection

@section('content')
    <div ng-cloak>
        <div class="row" ng-controller="Teacher">
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
                url: '{!! route('Teacher.searchData') !!}',
                data: function (d, context) {
                    DATATABLE.mergeSearch(d, context);
                }
            },
            columns: [
                {data: 'id', orderable: false},
                {data: 'DT_RowIndex', orderable: false, title: "STT", className: "text-center"},
                {data: 'fullname', title: 'Họ tên'},
                {data: 'cate_id', title: 'Danh mục'},
                {data: 'email', title: 'Email'},
                {data: 'phone_number', title: 'Email'},
                {data: 'phone_number', title: 'SĐT'},
                {data: 'address', title: 'Địa chỉ'},
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
                {data: 'fullname', search_type: "text", placeholder: "Tên giáo viên"},
                {
                    data: 'cate_id', search_type: "select", placeholder: "Danh mục",
                    column_data: [{id: 1, name: "Ban giám hiệu"}, {id: 2, name: "Điều phối chương trình Tiếng Anh"}, {id: 3, name: "Giáo viên"}]
                },
                {data: 'phone_number', search_type: "text", placeholder: "Số điện thoại"},
                {data: 'email', search_type: "text", placeholder: "Email"},
                {data: 'address', search_type: "text", placeholder: "Địa chỉ"},
                {
                    data: 'status', search_type: "select", placeholder: "Trạng thái",
                    column_data: [{id: 1, name: "Hoạt động"}, {id: -1, name: "Khóa"}]
                },
            ],
            @if(Auth::user()->type == App\Model\Common\User::SUPER_ADMIN || Auth::user()->type == App\Model\Common\User::QUAN_TRI_VIEN)
            create_link: "{{ route('Teacher.create') }}"
            @endif
        }).datatable;

        app.controller('Teacher', function ($scope, $rootScope, $http) {
            $scope.loading = {};
            $scope.arrayInclude = arrayInclude;

        })


    </script>
    @include('partial.confirm')
@endsection
