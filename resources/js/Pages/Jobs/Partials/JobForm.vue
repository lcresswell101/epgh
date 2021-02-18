<template>
    <div>

        <!--   Date & Time     -->
        <jet-form-section  @submitted="updateJobInformation">
            <template #title>
                Date & Time
            </template>

            <template #description>
                The jobs date & time
            </template>

            <template #form>
                <!-- Date -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="date" value="Date" />
                    <datepicker v-model="form.date" name="date"
                                input-class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                :disabledDates="state.disabledDates"
                    >
                    </datepicker>
                    <jet-input-error :message="form.errors.date" class="mt-2" />
                </div>

                <!-- Time -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="time" value="Time" />
                    <jet-input id="time" type="time" class="mt-1 block w-full" v-model="form.time" />
                    <jet-input-error :message="form.errors.time" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    Saved.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </jet-button>
            </template>
        </jet-form-section>

        <jet-section-border />

        <!--   Job Information     -->

        <jet-form-section class="mt-10 sm:mt-0" @submitted="updateJobInformation">
            <template #title>
                Information
            </template>

            <template #description>
                The information about the job
            </template>

            <template #form>
                <!-- Type -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="type" value="Type"><required /></jet-label>
                    <select-input v-model="form.type_id" class="mt-1 block w-full" :options="types" :selected="form.type_id"></select-input>
                    <jet-input-error :message="form.errors.type" class="mt-2" />
                </div>

                <!-- Status -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="status" value="Status"></jet-label>
                    <select-input v-model="form.status_id" class="mt-1 block w-full" :options="status" :selected="form.status_id"></select-input>
                    <jet-input-error :message="form.errors.status" class="mt-2" />
                </div>

                <!-- Information -->
                <div class="col-span-6">
                    <jet-label for="information" value="Information" />
                    <text-area-input id="information" v-model="form.information" class="mt-1 block w-full"/>
                    <jet-input-error :message="form.errors.information" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    Saved.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </jet-button>
            </template>
        </jet-form-section>

        <jet-section-border />

        <!--   Engineer     -->

        <jet-form-section class="mt-10 sm:mt-0" @submitted="updateJobInformation">
            <template #title>
                Engineer
            </template>

            <template #description>
                The engineer assigned
            </template>

            <template #form>
                <!-- Engineer -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="engineer" value="Engineer" />
                    <jet-input id="engineer" type="text" class="mt-1 block w-full" v-model="form.engineer" />
                    <jet-input-error :message="form.errors.engineer" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    Saved.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </jet-button>
            </template>
        </jet-form-section>

        <jet-section-border />

        <!--   Customer Details     -->

        <jet-form-section class="mt-10 sm:mt-0" @submitted="updateJobInformation">
            <template #title>
                Customer Details
            </template>

            <template #description>
                The customer details
            </template>

            <template #form>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="name" value="Name"><required /></jet-label>
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" />
                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-start-1 col-end-4">
                    <jet-label for="email" value="Email" />
                    <jet-input id="email" type="text" class="mt-1 block w-full" v-model="form.email" />
                    <jet-input-error :message="form.errors.email" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="col-start-4 col-end-7">
                    <jet-label for="phone" value="Phone"><required /></jet-label>
                    <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" />
                    <jet-input-error :message="form.errors.phone" class="mt-2" />
                </div>

                <!-- Address -->
                <div class="col-span-6">
                    <jet-label for="address" value="Address" />
                    <text-area-input id="address" v-model="form.address" class="mt-1 block w-full"/>
                    <jet-input-error :message="form.errors.address" class="mt-2" />
                </div>

                <!-- Postcode -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="postcode" value="Postcode" />
                    <jet-input id="postcode" type="text" class="mt-1 block w-full" v-model="form.postcode" />
                    <jet-input-error :message="form.errors.postcode" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    Saved.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </jet-button>
            </template>
        </jet-form-section>

        <jet-section-border />

        <!--   Costs     -->

        <jet-form-section class="mt-10 sm:mt-0" @submitted="updateJobInformation">
            <template #title>
                Costs
            </template>

            <template #description>
                The costs of the job
            </template>

            <template #form>
                <!-- Invoice Number -->
                <div class="col-span-6">
                    <jet-label for="invoice_number" value="Invoice Number" />
                    <jet-input id="invoice_number" type="text" class="mt-1 block w-full" v-model="form.invoice_number" />
                    <jet-input-error :message="form.errors.invoice_number" class="mt-2" />
                </div>

                <!-- Material Cost -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="first_hour_cost" value="First Hour Cost" />
                    <prepend-input id="first_hour_cost" type="number" step="0.01" class="mt-1 block" v-model="form.first_hour_cost">
                        <template #prepend>£</template>
                    </prepend-input>
                    <jet-input-error :message="form.errors.first_hour_cost" class="mt-2" />
                </div>

                <!-- Material Cost -->
                <div class="col-start-1 col-end-4">
                    <jet-label for="material_cost" value="Material Cost" />
                    <prepend-input id="material_cost" type="number" step="0.01" class="mt-1 block" v-model="form.material_cost" >
                        <template #prepend>£</template>
                    </prepend-input>
                    <jet-input-error :message="form.errors.material_cost" class="mt-2" />
                </div>

                <!-- Labour Cost -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="labour_cost" value="Labour Cost" />
                    <prepend-input id="labour_cost" type="number" step="0.01" class="mt-1 block" v-model="form.labour_cost" >
                        <template #prepend>£</template>
                    </prepend-input>
                    <jet-input-error :message="form.errors.labour_cost" class="mt-2" />
                </div>

                <!-- Paypal Fees -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="paypal_fee" value="Paypal Fee" />
                    <prepend-input id="paypal_fee" type="number" step="0.01" class="mt-1 block" v-model="form.paypal_fee" >
                        <template #prepend>£</template>
                    </prepend-input>
                    <jet-input-error :message="form.errors.paypal_fee" class="mt-2" />
                </div>

                <!-- Booking Fees -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="booking_fee" value="Booking Fee" />
                    <prepend-input id="booking_fee" type="number" step="0.01" class="mt-1 block" v-model="form.booking_fee" >
                        <template #prepend>£</template>
                    </prepend-input>
                    <jet-input-error :message="form.errors.booking_fee" class="mt-2" />
                </div>

                <!-- VAT -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="vat" value="VAT" />
                    <prepend-input id="vat" type="number" step="0.01" class="mt-1 block" v-model="form.vat">
                        <template #prepend>£</template>
                    </prepend-input>
                    <jet-input-error :message="form.errors.vat" class="mt-2" />
                </div>

                <!-- Total -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="total" value="Total" />
                    <prepend-input prepend="£" id="total" type="number" step="0.01" class="mt-1 block" v-model="form.total" >
                        <template #prepend>£</template>
                    </prepend-input>
                    <jet-input-error :message="form.errors.total" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    Saved.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </jet-button>
            </template>
        </jet-form-section>

        <template v-if="update">
            <jet-section-border />

            <delete-form class="mt-10 sm:mt-0"  :url="route('job.destroy', job.id)" type="job"/>
        </template>
    </div>
</template>

<script>

    import JetFormSection from '@/Jetstream/FormSection'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import TextAreaInput from "@/Components/TextAreaInput";
    import PrependInput from "@/Components/PrependInput";
    import SelectInput from "@/Components/SelectInput";
    import Required from "@/Components/Required";
    import DeleteForm from "@/Components/DeleteForm";
    import Datepicker from 'vuejs-datepicker';

    export default {
        name: "JobForm",
        props: {
            update: false,
            job: {},
            types: {},
            status: {}
        },
        components: {
            JetFormSection,
            JetActionMessage,
            JetButton,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
            JetSectionBorder,
            TextAreaInput,
            PrependInput,
            SelectInput,
            Required,
            DeleteForm,
            Datepicker
        },
        data(){
            return {
                form: this.$inertia.form({
                    _method: this.update ? 'PUT' : 'POST',
                    type_id: this.update ? this.job.type_id : this.types[0].id,
                    status_id: this.update ? this.job.status_id : this.status[0].id,
                    date: this.update ? this.job.date_formatted : '',
                    time: this.update ? this.job.time : '',
                    engineer: this.update ? this.job.engineer : '',
                    first_hour_cost: this.update ? this.job.first_hour_cost : '',
                    name: this.update ? this.job.name : '',
                    email: this.update ? this.job.email : '',
                    phone: this.update ? this.job.phone : '',
                    address: this.update ? this.job.address : '',
                    postcode: this.update ? this.job.postcode : '',
                    information: this.update ? this.job.information : '',
                    invoice_number: this.update ? this.job.invoice_number : '',
                    material_cost: this.update ? this.job.material_cost : '',
                    labour_cost: this.update ? this.job.labour_cost : '',
                    paypal_fee: this.update ? this.job.paypal_fee : '',
                    booking_fee: this.update ? this.job.booking_fee : '',
                    vat: this.update ? this.job.vat : '',
                    total: this.update ? this.job.total : '',
                }),
                state: {
                    disabledDates: {
                        to: new Date(new Date().toDateString())
                    }
                }
            }
        },
        methods: {
            updateJobInformation()
            {
                this.form.post(this.update ? route('job.update', this.job.id) : route('job.store'), {
                    errorBag: 'updateJobInformation',
                    preserveScroll: true,
                    onSuccess: () => {
                        !this.update ? this.form.reset() : '';
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
