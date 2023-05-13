
<template>
    <div class="relative min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <LoginForm :datauser="datauser" @sortClick="toggleSortOrder" @filterTextChanged="updateFilterText"></LoginForm>
        <ListOperation :datauser="datauser" :operations="filteredAndSortedOperations"></ListOperation>
    </div>
</template>

<script>

import LoginForm from './LoginForm.vue';
import ListOperation from './ListOperation.vue';
export default {
    name: 'App',
    data() {
        return {
            datauser: {},
            filterText: '',
            sortDescending: true
        }
    },
    created() {
        this.getData();

        if (this.datauser) {
            setInterval(() => {
                this.getData();
            }, 5000);
        }
    },
    components: {
        LoginForm,
        ListOperation,
    },
    computed: {
        filteredAndSortedOperations() {
            if (!this.datauser?.user?.operaions) {
                return [];
            }

            return this.datauser.user.operaions.filter(op => op.description.toLowerCase().includes(this.filterText.toLowerCase()))
                .sort((a, b) => {
                    return this.sortDescending ?
                        new Date(b.created_at) - new Date(a.created_at) :
                        new Date(a.created_at) - new Date(b.created_at);
                });
        }
    },
    methods: {
        async getData() {
            try {
                const response = await fetch('/data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    this.datauser = await response.json();
                } else {
                    this.errorMessage = 'Server error. Please try again later.';
                }
            } catch (error) {
                this.errorMessage = 'An error occurred. Please try again.';
            }
        },
        toggleSortOrder: function() {
            this.sortDescending = !this.sortDescending;
            this.sortedOperations();
        },
        sortedOperations: function() {
            return this.datauser?.user?.operaions?.sort((a, b) => {
                return this.sortDescending ?
                    new Date(b.created_at) - new Date(a.created_at) :
                    new Date(a.created_at) - new Date(b.created_at);
            });
        },
        updateFilterText: function(newFilterText) {
            this.filterText = newFilterText;
        }
    }
};
</script>
