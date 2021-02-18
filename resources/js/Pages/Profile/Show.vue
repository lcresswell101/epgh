<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <update-profile-information-form :user="$page.props.user" :update="true" :url="route('user-profile-information.update')" :deleteUrl="route('current-user-photo.destroy')"/>

                    <jet-section-border />
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <update-password-form class="mt-10 sm:mt-0" :url="route('user-password.update')"></update-password-form>

                    <jet-section-border />
                </div>

                <delete-form class="mt-10 sm:mt-0" :url="route('current-user.destroy')" type="user"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import DeleteForm from '@/Components/DeleteForm'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
    import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
    import UpdateProfileInformationForm from '@/Components/UpdateProfileInformationForm'
    import UpdatePasswordForm from "@/Components/UpdatePasswordForm";

    export default {
        props: ['sessions'],
        components: {
            AppLayout,
            DeleteForm,
            JetSectionBorder,
            LogoutOtherBrowserSessionsForm,
            TwoFactorAuthenticationForm,
            UpdateProfileInformationForm,
            UpdatePasswordForm,
        },
    }
</script>
