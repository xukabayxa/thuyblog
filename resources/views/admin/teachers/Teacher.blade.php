<script>
    class Teacher extends BaseClass {
        no_set = [];

        before(form) {
            this.image = {};
            this.status = 1;
            this.is_main = 1;
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

        get submit_data() {
            let data = {
                fullname: this.fullname,
                phone_number: this.phone_number,
                email: this.email,
                address: this.address,
                experience: this.experience,
                facebook: this.facebook,
                twitter: this.twitter,
                instagram: this.instagram,
                content: this.content,
                status: this.status,
                is_main: this.is_main,
                cate_id: this.cate_id,
            }

            data = jsonToFormData(data);
            let image = this.image.submit_data;
            if (image) data.append('image', image);

            return data;
        }
    }
</script>
