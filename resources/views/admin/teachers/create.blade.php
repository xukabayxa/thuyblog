@extends('layouts.main')

@section('page_title')
    Thêm mới giáo viên
@endsection

@section('title')
    Thêm mới giáo viên
@endsection

@section('title')
    Thêm mới giáo viên
@endsection
@section('content')
    <div ng-controller="CreateTeacher" ng-cloak>
        @include('admin.teachers.form')
    </div>
@endsection
@section('script')
    @include('admin.teachers.Teacher')

    <script>
        app.controller('CreateTeacher', function ($scope, $http) {
            $scope.arrayInclude = arrayInclude;
            $scope.loading = {};

            $scope.form = new Teacher({}, {scope: $scope});

                $scope.submit = function () {
                $scope.loading.submit = true;
                let data = $scope.form.submit_data;
                $.ajax({
                    type: 'POST',
                    url: "{!! route('Teacher.store') !!}",
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = "{{ route('Teacher.index') }}";
                        } else {
                            toastr.warning(response.message);
                            $scope.errors = response.errors;
                        }
                    },
                    error: function (e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function () {
                        $scope.loading.submit = false;
                        $scope.$applyAsync();
                    }
                });
            }

        });
    </script>
@endsection
