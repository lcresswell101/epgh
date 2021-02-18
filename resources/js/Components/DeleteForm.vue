<template>
    <jet-action-section>
        <template #title>
            <span class="capitalize">
                Delete {{ type }}
            </span>
        </template>

        <template #description>
            Permanently delete {{ type }}.
        </template>

        <template #content>
            <div class="mt-5">
                <jet-danger-button @click.native="confirmDeletion">
                    Delete {{ type }}
                </jet-danger-button>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <jet-dialog-modal :show="confirmingDeletion" @close="closeModal">
                <template #title>
                    Delete {{ type }}
                </template>

                <template #footer>
                    <jet-secondary-button @click.native="closeModal">
                        Nevermind
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click.native="deleteSubmit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Delete
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionSection,
            JetDangerButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
        },
        props: {
            url: '',
            type: ''
        },
        data() {
            return {
                confirmingDeletion: false,
                form: this.$inertia.form()
            }
        },

        methods: {
            confirmDeletion() {
                this.confirmingDeletion = true;

                setTimeout(() => this.$refs.password.focus(), 250)
            },

            deleteSubmit() {
                this.form.delete(this.url, {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                })
            },

            closeModal() {
                this.confirmingDeletion = false

                this.form.reset()
            },
        },
    }
</script>
