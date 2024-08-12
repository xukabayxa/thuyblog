@include('admin.gallery.Gallery')
<script>
    class Obj extends BaseClass {
        no_set = [];
        all_categories = @json(\App\Model\Admin\Category::getForSelect());

        before(form) {
            this.image = {};
            this.status = 0;
            this.attribute_values = form.attribute_values || [];
            this.videos = form.videos || [];
        }

        after(form) {

        }

        get base_price() {
            return this._base_price ? this._base_price.toLocaleString('en') : '';
        }

        set base_price(value) {
            value = parseNumberString(value);
            this._base_price = value;
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

        get galleries() {
            return this._galleries || [];
        }

        set galleries(value) {
            this._galleries = (value || []).map(val => new Gallery(val, this));
        }

        addGallery(gallery) {
            if (!this._galleries) this._galleries = [];
            let new_gallery = new Gallery(gallery, this);
            this._galleries.push(new_gallery);
            return new_gallery;
        }

        removeGallery(index) {
            this._galleries.splice(index, 1);
        }

        set attribute_values(value) {
            this._attributes = (value || []).map(val => new ProductAttribute(val, this));
        }

        get attribute_values() {
            return this._attributes;
        }

        addAttribute() {
            this._attributes.push(new ProductAttribute({}, this));
        }

        removeAttribute(index) {
            this._attributes.splice(index, 1);
        }

        set videos(value) {
            this._videos = (value || []).map(val => new ProductVideo(val, this));
        }

        get videos() {
            return this._videos;
        }

        addVideo() {
            console.log(this._videos)
            this._videos.push(new ProductVideo({}, this));
        }

        removeVideo(index) {
            this._videos.splice(index, 1);
        }

        get use_url_custom() {
            return this._use_url_custom;
        }

        set use_url_custom(value) {
            this._use_url_custom= !!Number(value) || null;
        }

        get manufacturer_id() {
            return this._manufacturer_id;
        }

        set manufacturer_id(value) {
            this._manufacturer_id = value || null;
        }

        get origin_id() {
            return this._origin_id;
        }

        set origin_id(value) {
            this._origin_id = value || null;
        }

        get documents() {
            return (this.attachments || '').split(', ').map(val => val.trim()).filter(val => !!val);
        }

        get submit_data() {
            let data = {

            }

            data = jsonToFormData(data);

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
