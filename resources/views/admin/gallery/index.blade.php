@extends('layouts.main')

@section('css')
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
          rel="stylesheet"/>
@endsection

@section('page_title')
    Quản lý thư viện
@endsection

@section('title')
    Quản lý thư viện
@endsection

@section('content')
    <style>
        .gallery-item {
            padding: 5px;
            padding-bottom: 0;
            border-radius: 2px;
            border: 1px solid #bbb;
            min-height: 100px;
            height: 100%;
            position: relative;
        }

        .gallery-item .remove {
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .gallery-item .drag-handle {
            position: absolute;
            top: 5px;
            left: 5px;
            cursor: move;
        }

        .gallery-item:hover {
            background-color: #eee;
        }

        .gallery-item .image-chooser img {
            max-height: 150px;
        }

        .gallery-item .image-chooser:hover {
            border: 1px dashed green;
        }
    </style>

    <div ng-controller="Gallery" ng-cloak>
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8">
                <div class="form-group text-center">
                    <label for="">Gallery ảnh</label>
                    <div class="row gallery-area border">
                        <div class="col-md-4 p-2" ng-repeat="g in form.galleries">
                            <div class="gallery-item">
                                <button class="btn btn-sm btn-danger remove" ng-click="form.removeGallery($index)">
                                    <i class="fa fa-times mr-0"></i>
                                </button>
                                <div class="form-group">
                                    <div class="img-chooser" title="Chọn ảnh">
                                        <label for="<% g.image.element_id %>">
                                            <img ng-src="<% g.image.path  %>">
                                            <input class="d-none" type="file" accept=".jpg,.png,.jpeg" id="<% g.image.element_id %>">
                                        </label>
                                    </div>
                                    <span class="invalid-feedback d-block" role="alert" ng-if="!errors['galleries.' + $index + '.image_obj']">
                                <strong>
                                    <% errors['galleries.' + $index + '.image' ][0] %>
                                </strong>
                            </span>
                                    <span class="invalid-feedback">
                                <strong>
                                    <% errors['galleries.' + $index + '.image_obj' ][0] %>
                                </strong>
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-2">
                            <label class="gallery-item d-flex align-items-center justify-content-center cursor-pointer" for="gallery-chooser">
                                <i class="fa fa-plus fa-2x text-secondary"></i>
                            </label>
                            <input class="d-none" type="file" accept=".jpg,.png,.jpeg" id="gallery-chooser" multiple>
                        </div>
                    </div>
                    <span class="invalid-feedback">
                <strong>
                    <% errors.galleries[0] %>
                </strong>
            </span>
                </div>
            </div>
            <div class="col-2">
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-success btn-cons" ng-click="submit()" ng-disabled="loading.submit">
                <i ng-if="!loading.submit" class="fa fa-save"></i>
                <i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
                Lưu
            </button>
        </div>
    </div>

@endsection

@section('script')
@include('admin.gallery.Object')
{{--@include('admin.products.Product')--}}

<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script>
        app.controller('Gallery', function ($scope, $rootScope, $http) {
            $scope.loading = {};
            $scope.arrayInclude = arrayInclude;

            $scope.form = new Obj(@json($obj), {scope: $scope});

            $(document).on('change', '#gallery-chooser', function(e) {
                Array.from(this.files).forEach(file => {
                    let item = $scope.form.addGallery({});
                    setTimeout(() => {
                        let e = document.getElementById(item.image.element_id);
                        let dataTransfer = new DataTransfer()
                        dataTransfer.items.add(file)
                        e.files = dataTransfer.files
                        $(e).trigger('change');
                    })
                });
                $scope.$apply();
            })

            $scope.submit = function () {
                $scope.loading.submit = true;
                let data = $scope.form.submit_data;
                $.ajax({
                    type: 'POST',
                    url: "{!! route('gallery.store') !!}",
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
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
        })


    </script>
    @include('partial.confirm')
@endsection
