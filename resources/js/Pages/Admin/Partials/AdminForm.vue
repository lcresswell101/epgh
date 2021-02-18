<template>
    <div>
        <jet-form-section @submitted="updateTypeInformation">
            <template #title>
               Types
            </template>

            <template #description>
                The job types
            </template>

            <template #form>
                <div class="col-span-6 sm:col-span-3">
                    <options-input type="types" :options="job_types" @returnOptions="setTypes"></options-input>
                    <jet-input-error :message="types_form.errors.options" class="mt-2" />
                </div>
            </template>



            <template  #actions>
                <jet-action-message :on="types_form.recentlySuccessful" class="mr-3">
                    Saved.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': types_form.processing }" :disabled="types_form.processing">
                    Save
                </jet-button>
            </template>
        </jet-form-section>

        <jet-section-border />

        <jet-form-section @submitted="updateStatusInformation">
            <template #title>
                Statuses
            </template>

            <template #description>
                The job statuses
            </template>

            <template #form>
                <div class="col-span-6 sm:col-span-3">
                    <options-input type="status" :options="job_status" @returnOptions="setStatus"></options-input>
                    <jet-input-error :message="status_form.errors.options" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="status_form.recentlySuccessful" class="mr-3">
                    Saved.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': status_form.processing }" :disabled="status_form.processing">
                    Save
                </jet-button>
            </template>
        </jet-form-section>
    </div>
</template>

<script>

    import JetFormSection from "@/Jetstream/FormSection";
    import JetActionMessage from "@/Jetstream/ActionMessage";
    import JetButton from "@/Jetstream/Button";
    import JetSectionBorder from "@/Jetstream/SectionBorder";
    import JetInputError from "@/Jetstream/InputError";
    import OptionsInput from "@/Components/OptionsInput";

    export default {
        name: "AdminForm",
        components: {
            JetFormSection,
            JetActionMessage,
            JetButton,
            JetSectionBorder,
            JetInputError,
            OptionsInput
        },
        props: {
            job_types: {
                type: Array,
                default: []
            },
            job_status: {
                type: Array,
                default: []
            },
        },
        data()
        {
            return {
                test: 'test',
                types_form: this.$inertia.form({
                    _method: 'PUT',
                    options: []
                }),
                status_form: this.$inertia.form({
                    _method: 'PUT',
                    options: []
                })
            }
        },
        methods: {
            setTypes(val)
            {
                this.types_form.options = val;
            },
            setStatus(val)
            {
                this.status_form.options = val;
            },
            updateTypeInformation()
            {
                this.types_form.post(route('type.update'));
            },
            updateStatusInformation()
            {
                this.status_form.post(route('status.update'));
            }
        }
}
</script>

<style scoped>

</style>
