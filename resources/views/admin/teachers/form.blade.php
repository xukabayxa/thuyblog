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
            <label class="form-label required-label">Tên giáo viên</label>
            <input class="form-control " type="text" ng-model="form.fullname">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.fullname[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Danh mục</label>
            <select id="my-select" class="form-control custom-select" ng-model="form.cate_id">
                <option value="1">Ban Giám hiệu</option>
                <option value="2">Điều phối chương trình Tiếng Anh</option>
                <option value="3">Giáo viên</option>
            </select>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.cate_id[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Số điện thoại</label>
            <input class="form-control " type="text" ng-model="form.phone_number">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.phone_number[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Địa chỉ</label>
            <input class="form-control " type="text" ng-model="form.address">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.address[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Email</label>
            <input class="form-control " type="text" ng-model="form.email">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.email[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Kinh nghiệm</label>
            <input class="form-control " type="text" ng-model="form.experience">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.experience[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Giới thiệu</label>
            <textarea class="form-control" ck-editor rows="5" ng-model="form.content"></textarea>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.content[0] %>
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
            <label class="form-label">Facebook</label>
            <input class="form-control " type="text" ng-model="form.facebook">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.facebook[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Twitter</label>
            <input class="form-control " type="text" ng-model="form.twitter">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.facebook[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Instagram</label>
            <input class="form-control " type="text" ng-model="form.instagram">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.facebook[0] %>
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
