export default {
    name: "ListOperation",
    props: ['datauser', 'operations'],
    data() {
        return {
            user_name: '',
        };
    },
    watch: {
        datauser: function(newVal, oldVal) {
            if(newVal) {
                this.user_name = newVal?.user?.name;
            }
        }
    },
};
