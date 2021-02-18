<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Job
            </h2>
        </template>

        <content-container class="pb-12">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <job-form :types="types" :status="status"/>
            </div>
        </content-container>

    </app-layout>
</template>

<script>

    import AppLayout from '@/Layouts/AppLayout'
    import ContentContainer from "@/Components/ContentContainer";
    import JobForm from "@/Pages/Jobs/Partials/JobForm";

    export default {
        name: "Create",
        props: {
            types: {},
            status: {}
        },
        components: {
            AppLayout,
            ContentContainer,
            JobForm
        }
    }
</script>
