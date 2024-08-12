<script>
    class Consultant extends BaseClass {
        no_set = [];

        before(form) {
        }

        after(form) {

        }

        // Ảnh đại diện

        get submit_data() {
            let data = {
                name: this.name,
                phone: this.phone,
            }

            return data;
        }
    }
</script>
