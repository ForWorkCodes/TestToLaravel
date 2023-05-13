export default {
    name: "LoginForm",
    data() {
        return {
            email: '',
            password: '',
            user_name: '',
            balance: '',
        };
    },
    watch: {
        datauser: function(newVal, oldVal) {
            if(newVal) {
                this.user_name = newVal?.user?.name;
                this.balance = newVal?.user?.balance?.amount;
            }
        }
    },
    props: ['datauser'],
    methods: {
        toggleSortOrder() {
            this.$emit('sortClick');
        },
        toggleFilter(e) {
            this.$emit('filterTextChanged', e.target.value);
        },
        async submitForm() {
            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        email: this.email,
                        password: this.password
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    if (data.message) {
                        location.href = location.href;
                    } else {
                        alert(data.error);
                    }
                } else {
                    alert(data.error);
                }
            } catch (error) {
                alert('An error occurred. Please try again.');
            }
        }
    }
};
