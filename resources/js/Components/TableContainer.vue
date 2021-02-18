<template>
    <div>
        <content-container>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-12 xl:col-start-1 xl:col-end-5 flex items-end">
                        <export :model="model" :actions="actions" :exports="mutableExport"></export>
                    </div>
                    <div class="col-span-12 xl:col-start-5 xl:col-end-7">
                        <search :model="model" :user="user" @returnSearch="setSearch" @returnReset="resetData"></search>
                    </div>
                </div>
            </div>
        </content-container>

        <template v-if="mutableData.length > 0">
            <content-container>
                <table-component :model="model"
                                 :data="mutableData"
                                 :hidden="hidden"
                                 :sortable="sortable"
                                 :actions="actions"
                                 :dates="dates"
                                 :images="images"
                                 @returnExport="setExport"
                >
                </table-component>
            </content-container>

            <pagination :model="model" :user="user" :data="mutableData" :pagination_data="mutablePagination" :search="mutableSearch" @returnPaginate="setPagination"></pagination>
        </template>
        <template v-else>
            <content-container>
                <div class="bg-red-700 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <span class="text-white">
                        No {{ model }} Found!
                    </span>
                </div>
            </content-container>
        </template>
    </div>
</template>

<script>

    import ContentContainer from "@/Components/ContentContainer";
    import TableComponent from "@/Components/Table";
    import Export from "@/Components/Export";
    import Search from "@/Components/Search";
    import Pagination from "@/Components/Pagination";

    export default {
        name: "TableContainer",
        components: {
            ContentContainer,
            TableComponent,
            Export,
            Search,
            Pagination
        },
        props: {
            model: '',
            user: {},
            data: {},
            hidden: {
                type: Array,
                default: []
            },
            actions: {
                type: Array,
                default: []
            },
            sortable: {
                type: Array,
                default: []
            },
            images: {
                type: Array,
                default: []
            },
            dates: {
                type: Array,
                default: []
            },
            pagination_data: {}
        },
        data()
        {
            return {
                mutableData: {},
                mutablePagination: {},
                mutableSearch: false,
                mutableExport: []
            }
        },
        methods: {
            getData(val, paginate = false)
            {
                if(paginate)
                    this.mutableData.push(...val.results);
                else
                    this.mutableData = val.results;
            },
            setSearch(val)
            {
                this.resetPagination();
                this.mutableSearch = val.search;
                this.getData(val);
            },
            setPagination(val)
            {
                this.mutablePagination = val.pagination_data;
                this.getData(val, true);
            },
            setExport(val)
            {
                this.mutableExport = val;
            },
            resetData()
            {
                this.resetPagination()
                this.resetSearch();
                this.getData(this.data);
            },
            resetPagination()
            {
                this.mutablePagination.current_page = 1;
            },
            resetSearch()
            {
                this.mutableSearch = false;
            },
        },
        mounted()
        {
            this.mutablePagination = this.pagination_data;
            this.getData(this.data);
        }
    }
</script>

<style scoped>

</style>
