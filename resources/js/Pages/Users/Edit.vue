<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User
            </h2>
        </template>

        <content-container>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <update-profile-information-form :user="user_edited" :update="true" :url="route('user.update', user_edited.id)" :deleteUrl="route('user.delete-photo', user_edited.id)"/>

                    <jet-section-border />
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <update-password-form class="mt-10 sm:mt-0" :url="route('user.update-password', user_edited.id)"></update-password-form>

                    <jet-section-border />
                </div>

                <delete-form class="mt-10 sm:mt-0" :url="route('user.destroy', user_edited.id)" type="user"/>
            </div>
        </content-container>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ContentContainer from "@/Components/ContentContainer";
import DeleteForm from '@/Components/DeleteForm'
import JetSectionBorder from '@/Jetstream/SectionBorder'
import UpdateProfileInformationForm from '@/Components/UpdateProfileInformationForm'
import UpdatePasswordForm from "@/Components/UpdatePasswordForm";

export default {
    props: ['sessions', 'user_edited'],
    components: {
        AppLayout,
        ContentContainer,
        DeleteForm,
        JetSectionBorder,
        UpdateProfileInformationForm,
        UpdatePasswordForm,
    },
}
</script>
