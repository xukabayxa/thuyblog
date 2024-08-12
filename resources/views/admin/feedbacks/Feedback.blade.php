<script>
    class Feedback extends BaseClass {
        no_set = [];

        before(form) {
        }

        after(form) {

        }

        // Ảnh đại diện

        get submit_data() {
            let data = {
                customer_name: this.customer_name,
                customer_address: this.customer_address,
                content: this.content,
            }

            return data;
        }
    }
</script>
