<template>
    <!-- Search -->
    <prepend-input id="total" type="text" class="mt-1 block w-full" v-model="search">
        <template #prepend>
            <search-icon></search-icon>
        </template>
    </prepend-input>
</template>

<script>
    import PrependInput from "@/Components/PrependInput";
    import SearchIcon from "@/Resources/Search";

    export default {
        name: "Search",
        components: {
            PrependInput,
            SearchIcon
        },
        props: {
            model: '',
            user: ''
        },
        data()
        {
            return {
                search: '',
                api_token: this.user.api_token
            }
        },
        watch: {
            search(newVal, oldVal)
            {
                if(newVal)
                {
                    axios
                        .get(`api/${this.model}/search?api_token=${this.api_token}&search=${newVal}`)
                        .then(response => this.returnSearch(response.data));
                }else
                {
                    this.returnReset();
                }
            }
        },
        methods: {
            returnSearch(val)
            {
                this.$emit('returnSearch', val);
            },
            returnReset()
            {
                this.$emit('returnReset');
            }
        }
    }
</script>

<style scoped>

</style>
