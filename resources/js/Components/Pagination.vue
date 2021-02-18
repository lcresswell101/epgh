<template>
    <div class="py-12">
        <div v-if="notLastPage && !notMoreResults">
            <div class="flex justify-center max-w-7xl mx-auto sm:px-6 lg:px-8">
                <jet-button :class="{ 'opacity-25': loading }" :disabled="loading" @click.native="paginate">
                    Load More
                </jet-button>
            </div>
        </div>
    </div>
</template>

<script>

import JetButton from '@/Jetstream/Button';

export default {
    name: "Pagination",
    components: {
        JetButton
    },
    props: {
        model: '',
        user: '',
        data: {},
        pagination_data: {},
        search: false
    },
    data()
    {
        return {
            loading: false,
            api_token: this.user.api_token
        }
    },
    computed: {
        notLastPage()
        {
            return this.pagination_data.current_page !== this.pagination_data.last_page;
        },
        notMoreResults()
        {
            return this.data.length < this.pagination_data.posts_per_page;
        }
    },
    methods: {
        paginate()
        {
            console.log(this.search);
            axios
                .get(`api/${this.model}/search?api_token=${this.api_token}&search=${this.search}&page=${this.pagination_data.current_page + 1}`)
                .then(response => this.returnPaginate(response.data));
        },
        returnPaginate(val)
        {
            this.$emit('returnPaginate', val);
        }
    }
}
</script>

<style scoped>

</style>
