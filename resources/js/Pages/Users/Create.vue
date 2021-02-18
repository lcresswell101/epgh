<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create User
            </h2>
        </template>

        <content-container>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <user-form :user="user"/>
            </div>
        </content-container>

    </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout'
import ContentContainer from "@/Components/ContentContainer";
import UserForm from "@/Pages/Users/Partials/UserForm";

export default {
    name: "Create",
    components: {
        AppLayout,
        ContentContainer,
        UserForm
    },
    props: {
        'user': {}
    }
}
</script>
