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
<div class="row">
    <div class="col-sm-8">
        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Tên lớp học</label>
            <input class="form-control " type="text" ng-model="form.title">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.title[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Lịch học</label>
            <input class="form-control " type="text" ng-model="form.learn_day">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.learn_day[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Độ tuổi</label>
            <input class="form-control " type="text" ng-model="form.age">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.age[0] %>
                </strong>
            </span>
        </div>

{{--        <div class="row">--}}
{{--            <div class="col-sm-6">--}}
{{--                <div class="form-group custom-group mb-4">--}}
{{--                    <label class="form-label required-label">Ngày bắt đầu mở lớp</label>--}}
{{--                    <input class="form-control" type="text" date ng-model="form.from_time">--}}
{{--                    <span class="invalid-feedback d-block" role="alert">--}}
{{--                    <strong>--}}
{{--                        <% errors.from_time[0] %>--}}
{{--                    </strong>--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6">--}}
{{--                <div class="form-group custom-group mb-4">--}}
{{--                    <label class="form-label required-label">Ngày kết thúc lớp</label>--}}
{{--                    <input class="form-control" type="text" date ng-model="form.end_time">--}}
{{--                    <span class="invalid-feedback d-block" role="alert">--}}
{{--                    <strong>--}}
{{--                        <% errors.end_time[0] %>--}}
{{--                    </strong>--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


        <div class="row">
            <div class="col-sm-6">
                <div class="form-group custom-group mb-4">
                    <label class="form-label required-label">Thời gian vào học</label>
                    <input class="form-control" type="text" time ng-model="form.time_start">
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>
                        <% errors.time_start[0] %>
                    </strong>
                    </span>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group custom-group mb-4">
                    <label class="form-label required-label">Thời gian tan học</label>
                    <input class="form-control" type="text" time ng-model="form.time_end">
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>
                        <% errors.to_time[0] %>
                    </strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Giới thiệu ngắn</label>
            <textarea class="form-control" ck-editor rows="5" ng-model="form.short_des"></textarea>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.short_des[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Mô tả</label>
            <textarea class="form-control" ck-editor rows="5" ng-model="form.description"></textarea>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.description[0] %>
                </strong>
            </span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group text-center">
            <div class="main-img-preview">
                <p class="help-block-img">* Ảnh định dạng: jpg, png không quá 2MB.</p>
                <img class="thumbnail img-preview" ng-src="<% form.image.path %>">
            </div>
            <div class="input-group" style="width: 100%; text-align: center">
                <div class="input-group-btn" style="margin: 0 auto">
                    <div class="fileUpload fake-shadow cursor-pointer">
                        <label class="mb-0" for="<% form.image.element_id %>">
                            <i class="glyphicon glyphicon-upload"></i> Chọn ảnh
                        </label>
                        <input class="d-none" id="<% form.image.element_id %>" type="file" class="attachment_upload" accept=".jpg,.jpeg,.png">
                    </div>
                </div>
            </div>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.image[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Trạng thái</label>
            <select id="my-select" class="form-control custom-select" ng-model="form.status">
                <option value="">Chọn trạng thái</option>
                <option value="1">Hoạt động</option>
                <option value="0">Khóa</option>
            </select>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.status[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Ghim ngoài trang chủ</label>
            <select id="my-select" class="form-control custom-select" ng-model="form.is_main">
                <option value="1">Ghim</option>
                <option value="0">Bỏ ghim</option>
            </select>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.is_main[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Giá tiền</label>
            <input class="form-control" type="text" ng-model="form.price" placeholder="Giá tiền">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.facebook[0] %>
                </strong>
            </span>
        </div>

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
                                    <img ng-src="<% g.image.path %>">
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


        <hr>

    </div>
</div>
<hr>
<div class="text-right">
    <button type="submit" class="btn btn-success btn-cons" ng-click="submit()" ng-disabled="loading.submit">
        <i ng-if="!loading.submit" class="fa fa-save"></i>
        <i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
        Lưu
    </button>
    <a href="{{ route('Category.index') }}" class="btn btn-danger btn-cons">
        <i class="fa fa-remove"></i> Hủy
    </a>
</div>
