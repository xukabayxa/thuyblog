<script>
    class Config extends BaseClass {
        no_set = [];
        before(form) {
            this.image = {};
        }
        after(form) {
        }
        get image() {
            return this._image;
        }
        set image(value) {
            this._image = new Image(value, this);
        }
		clearImage() {
			if (this.image) this.image.clear();
		}

        get favicon() {
            return this._favicon;
        }

        set favicon(value) {
            this._favicon= new Image(value, this);
        }

        clearFavicon() {
            if (this.favicon) this.favicon.clear();
        }
        get submit_data() {
            let data = {
                web_title: this.web_title,
                short_name_company: this.short_name_company,
                web_des: this.web_des,
                email: this.email,
                twitter: this.twitter,
                instagram: this.instagram,
                youtube: this.youtube,
                facebook: this.facebook,
                hotline: this.hotline,
                address_company: this.address_company,
                address_center_insurance: this.address_center_insurance,
                zalo: this.zalo,
                location: this.location,
                click_call: this.click_call,
                facebook_chat: this.facebook_chat,
                zalo_chat: this.zalo_chat,
                phone_switchboard: this.phone_switchboard,
                introduction: this.introduction,
                fax: this.fax,
                line_text_1: this.line_text_1,
                line_text_2: this.line_text_2,
                line_text_3: this.line_text_3,
                about1: this.about1,
                about2: this.about2,
            }
            data = jsonToFormData(data);
            let image = this.image.submit_data;
            if (image) data.append('image', image);
            let favicon = this.favicon.submit_data;
            if (favicon) data.append('favicon', favicon);

            return data;
        }
    }
</script>
