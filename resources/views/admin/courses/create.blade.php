@extends('layouts.main')

@section('page_title')
    Thêm mới lớp học
@endsection

@section('title')
    Thêm mới lớp học
@endsection

@section('title')
    Thêm mới lớp học
@endsection
@section('content')
    <div ng-controller="CreateCourse" ng-cloak>
        @include('admin.courses.form')
    </div>
@endsection
@section('script')
    @include('admin.courses.Course')

    <script>
        app.controller('CreateCourse', function ($scope, $http) {
            $scope.arrayInclude = arrayInclude;
            $scope.loading = {};

            $scope.form = new Course({}, {scope: $scope});
            @include('admin.products.formJs')

                $scope.submit = function () {
                $scope.loading.submit = true;
                let data = $scope.form.submit_data;
                $.ajax({
                    type: 'POST',
                    url: "{!! route('Courses.store') !!}",
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = "{{ route('Courses.index') }}";
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
