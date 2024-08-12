<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Tên khách hàng</label>
                    <input class="form-control " type="text" ng-model="form.customer_name">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.customer_name[0] %></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Địa chỉ</label>
                    <input class="form-control " type="text" ng-model="form.customer_address">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.customer_address[0] %></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Nội dung</label>
                    <textarea id="editor" class="form-control" ck-editor ng-model="form.content" rows="3"></textarea>
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.content[0] %></strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
