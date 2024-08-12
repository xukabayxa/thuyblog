<div class="card" style="max-width: 1200px; margin: 0 auto;">
	<div class="card-body">
		<div class="row">
			<div class="col-md-8 col-xs-12">
				<div class="form-group custom-group">
					<label class="form-label required-label">Tiêu đề website</label>
					<input class="form-control" ng-model="form.web_title" type="text">
					<span class="invalid-feedback d-block" role="alert">
						<strong><% errors.web_title[0] %></strong>
					</span>
				</div>
                <div class="form-group custom-group">
                    <label class="form-label">Tên công ty viết gọn</label>
                    <input class="form-control" ng-model="form.short_name_company" type="text">
                    <span class="invalid-feedback d-block" role="alert">
						<strong><% errors.short_name_company[0] %></strong>
					</span>
                </div>
				<div class="form-group custom-group">
					<label class="form-label required-label">Số hotline</label>
					<input class="form-control" ng-model="form.hotline" type="text">
					<span class="invalid-feedback d-block" role="alert">
						<strong><% errors.hotline[0] %></strong>
					</span>
				</div>
                <div class="form-group custom-group">
                    <label class="form-label">Số tổng đài</label>
                    <input class="form-control" ng-model="form.phone_switchboard" type="text">
                </div>
				<div class="form-group custom-group">
					<label class="form-label required-label">Số Zalo</label>
					<input class="form-control" ng-model="form.zalo" type="text">
					<span class="invalid-feedback d-block" role="alert">
						<strong><% errors.zalo[0] %></strong>
					</span>
				</div>
                <div class="form-group custom-group">
                    <label class="form-label">Fax</label>
                    <input class="form-control" ng-model="form.fax" type="text">
                </div>
                <div class="form-group custom-group">
                    <label class="form-label">Địa chỉ công ty</label>
                    <input class="form-control" ng-model="form.address_company" type="text">
                </div>

				<div class="form-group custom-group">
					<label class="form-label required-label">Email</label>
					<input class="form-control" ng-model="form.email" type="text">
					<span class="invalid-feedback d-block" role="alert">
						<strong><% errors.email[0] %></strong>
					</span>
				</div>
				<div class="form-group custom-group">
					<label class="form-label required-label">Fanpage Facebook</label>
					<input class="form-control" ng-model="form.facebook" type="text">
					<span class="invalid-feedback d-block" role="alert">
						<strong><% errors.facebook[0] %></strong>
					</span>
				</div>
                <div class="form-group custom-group">
                    <label class="form-label">Twitter</label>
                    <input class="form-control" ng-model="form.twitter" type="text">
                </div>
                <div class="form-group custom-group">
                    <label class="form-label">Instagram</label>
                    <input class="form-control" ng-model="form.instagram" type="text">
                </div>
                <div class="form-group custom-group">
                    <label class="form-label">Youtube</label>
                    <input class="form-control" ng-model="form.youtube" type="text">
                </div>
                <div class="form-group custom-group">
                    <label class="form-label required-label">Dòng text banner trang chủ 1</label>
                    <input class="form-control" ng-model="form.line_text_1" type="text">
                    <span class="invalid-feedback d-block" role="alert">
						<strong><% errors.line_text_1[0] %></strong>
					</span>
                </div>
                <div class="form-group custom-group">
                    <label class="form-label required-label">Dòng text banner trang chủ 2</label>
                    <textarea class="form-control ck-editor" ck-editor rows="5" ng-model="form.line_text_2"></textarea>
                    <span class="invalid-feedback d-block" role="alert">
						<strong><% errors.line_text_2[0] %></strong>
					</span>
                </div>
                <div class="form-group custom-group">
                    <label class="form-label required-label">Dòng text banner trang chủ 3</label>
                    <input class="form-control" ng-model="form.line_text_3" type="text">
                    <span class="invalid-feedback d-block" role="alert">
						<strong><% errors.line_text_3[0] %></strong>
					</span>
                </div>

                <div class="form-group custom-group">
                    <label class="form-label required-label">About 1</label>
                    <textarea id="my-textarea" class="form-control" ng-model="form.about1" rows="3"></textarea>
                    <span class="invalid-feedback d-block" role="alert">
						<strong><% errors.about1[0] %></strong>
					</span>
                </div>
                <div class="form-group custom-group">
                    <label class="form-label required-label">About 2</label>
                    <textarea class="form-control ck-editor" ck-editor rows="5" ng-model="form.about2"></textarea>
                    <span class="invalid-feedback d-block" role="alert">
						<strong><% errors.about2[0] %></strong>
					</span>
                </div>


                <div class="form-group">
					<label class="form-label">Tùy chọn khác</label>
					<div class="custom-control custom-checkbox">
						<input id="call" class="custom-control-input" type="checkbox" ng-model="form.click_call" ng-true-value="1" ng-false-value="0">
						<label for="call" class="custom-control-label">Click call</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input id="face-chat" class="custom-control-input" type="checkbox" ng-model="form.facebook_chat"  ng-true-value="1" ng-false-value="0">
						<label for="face-chat" class="custom-control-label">Chatbox Facebook</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input id="zalo-chat" class="custom-control-input" type="checkbox" ng-model="form.zalo_chat"  ng-true-value="1" ng-false-value="0">
						<label for="zalo-chat" class="custom-control-label">Zalo chat</label>
					</div>
				</div>
				<div class="form-group custom-group">
					<label class="form-label required-label">Mô tả web</label>
					<textarea id="my-textarea" class="form-control" ng-model="form.web_des" rows="3"></textarea>
					<span class="invalid-feedback d-block" role="alert">
						<strong><% errors.web_des[0] %></strong>
					</span>
				</div>
                <div class="form-group custom-group">
                    <label class="form-label">Giờ mở cửa làm việc</label>
                    <textarea class="form-control ck-editor" ck-editor rows="3" ng-model="form.address_center_insurance"></textarea>
                </div>
                <div class="form-group custom-group">
                    <label class="form-label">Bài viết giới thiệu</label>
                    <textarea class="form-control ck-editor" ck-editor rows="5" ng-model="form.introduction"></textarea>
                </div>
			</div>
			<div class="col-md-4 col-xs-12">
				<div class="form-group text-center mb-4">
					<label class="form-label required-label">Logo</label>
					<div class="main-img-preview">
						<p class="help-block-img">* Ảnh định dạng: jpg, png không quá 1MB.</p>
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
						<strong><% errors.image[0] %></strong>
					</span>
				</div>

                <div style=""></div>

                <div class="form-group text-center mb-4">
                    <label class="form-label required-label">Favicon</label>
                    <div class="main-img-preview">
                        <p class="help-block-img">* Ảnh định dạng: jpg, png không quá 1MB, kích thước 16x16 </p>
                        <img class="thumbnail img-preview" ng-src="<% form.favicon.path %>">
                    </div>
                    <div class="input-group" style="width: 100%; text-align: center">
                        <div class="input-group-btn" style="margin: 0 auto">
                            <div class="fileUpload fake-shadow cursor-pointer">
                                <label class="mb-0" for="<% form.favicon.element_id %>">
                                    <i class="glyphicon glyphicon-upload"></i> Chọn ảnh
                                </label>
                                <input class="d-none" id="<% form.favicon.element_id %>" type="file" class="attachment_upload" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                    </div>
                    <span class="invalid-feedback d-block" role="alert">
						<strong><% errors.favicon[0] %></strong>
					</span>
                </div>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="text-right">
	<button type="submit" class="btn btn-success btn-cons" ng-click="submit()" ng-disabled="loading.submit">
		<i ng-if="!loading.submit" class="fa fa-save"></i>
		<i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
		Lưu
	</button>
</div>
