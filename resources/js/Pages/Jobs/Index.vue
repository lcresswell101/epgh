<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Jobs
            </h2>
        </template>

        <table-container model="job"
                         :user="$page.props.user"
                         :data="jobs"
                         :hidden="attributes.hidden"
                         :sortable="attributes.sortable"
                         :actions="actions"
                         :dates="attributes.dates"
                         :images="attributes.images"
                         :pagination_data="pagination_data">
        </table-container>
    </app-layout>
</template>

<script>

    import AppLayout from '@/Layouts/AppLayout'
    import TableContainer from "@/Components/TableContainer";

    export default {
        name: "Index",
        components: {
            AppLayout,
            TableContainer
        },
        props: {
            attributes: {},
            actions: {},
            pagination_data: {},
            jobs: {}
        }
    }
</script>
