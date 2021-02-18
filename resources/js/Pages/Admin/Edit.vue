<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin Panel
            </h2>
        </template>

        <content-container class="pb-12">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <admin-form :job_types="job_types" :job_status="job_status"></admin-form>
            </div>
        </content-container>
    </app-layout>
</template>

<script>

    import AppLayout from "@/Layouts/AppLayout";
    import ContentContainer from "@/Components/ContentContainer";
    import AdminForm from "@/Pages/Admin/Partials/AdminForm";

    export default {
        name: "Edit",
        components: {
            AppLayout,
            ContentContainer,
            AdminForm
        },
        props: {
            job_types: {
                type: Array,
                default: []
            },
            job_status: {
                type: Array,
                default: []
            }
        }
    }
</script>

<style scoped>

</style>
