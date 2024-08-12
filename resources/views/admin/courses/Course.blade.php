@include('admin.courses.CourseGallery')

<script>
    class Course extends BaseClass {
        no_set = [];

        before(form) {
            this.image = {};
            this.status = 1;
            this.is_main = 1;
        }

        after(form) {

        }

        get price() {
            return this._price ? this._price.toLocaleString('en') : '';
        }

        set price(value) {
            value = parseNumberString(value);
            this._price = value;
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

        get from_time() {
            return dateGetter(this._from_time, 'YYYY-MM-DD', "DD/MM/YYYY");
        }

        set from_time(value) {
            this._from_time = dateSetter(value, "DD/MM/YYYY", 'YYYY-MM-DD');
        }

        get end_time() {
            return dateGetter(this._end_time, 'YYYY-MM-DD', "DD/MM/YYYY");
        }

        set end_time(value) {
            this._end_time = dateSetter(value, "DD/MM/YYYY", 'YYYY-MM-DD');
        }

        get galleries() {
            return this._galleries || [];
        }

        set galleries(value) {
            this._galleries = (value || []).map(val => new CourseGallery(val, this));
        }

        addGallery(gallery) {
            if (!this._galleries) this._galleries = [];
            let new_gallery = new CourseGallery(gallery, this);
            this._galleries.push(new_gallery);
            return new_gallery;
        }

        removeGallery(index) {
            this._galleries.splice(index, 1);
        }

        get submit_data() {
            let data = {
                title: this.title,
                short_des: this.short_des,
                description: this.description,
                learn_day: this.learn_day,
                age: this.age,
                time_start: this.time_start,
                time_end: this.time_end,
                from_time: this._from_time,
                end_time: this._end_time,
                price: this._price,
                status: this.status,
                is_main: this.is_main,
            }

            data = jsonToFormData(data);
            let image = this.image.submit_data;
            if (image) data.append('image', image);

            this.galleries.forEach((g, i) => {
                if (g.id) data.append(`galleries[${i}][id]`, g.id);
                let gallery = g.image.submit_data;
                if (gallery) data.append(`galleries[${i}][image]`, gallery);
                else data.append(`galleries[${i}][image_obj]`, g.id);
            })

            return data;
        }
    }
</script>
