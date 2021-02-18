<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Show Job
            </h2>
        </template>

        <content-container>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <section-component>
                    <template #title>
                        Booking time & date
                    </template>

                    <template #content>
                        <dl>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Date
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.date }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Time
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.time }}
                                </dd>
                            </div>
                        </dl>
                    </template>
                </section-component>

                <jet-section-border />

                <section-component>
                    <template #title>
                        Job Details
                    </template>

                    <template #content>
                        <dl>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Type
                                </dt>
                                <dd class="capitalize mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.type.name }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Engineer
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.engineer }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Status
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.status.name }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Information
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.information }}
                                </dd>
                            </div>
                        </dl>
                    </template>
                </section-component>

                <jet-section-border />

                <section-component>
                    <template #title>
                        Customer Details
                    </template>

                    <template #content>
                        <dl>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Name
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.name }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Email
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.email }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Phone
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.phone }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Address
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.address }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Postcode
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.postcode }}
                                </dd>
                            </div>
                        </dl>
                    </template>
                </section-component>

                <jet-section-border />

                <section-component>
                    <template #title>
                        Invoice Details
                    </template>

                    <template #content>
                        <dl>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Invoice number
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ job.invoice_number }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    First hour cost
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ appendCurrency(job.first_hour_cost) }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Material cost
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ appendCurrency(job.material_cost) }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Labour cost
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ appendCurrency(job.labour_cost) }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Paypal fee
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ appendCurrency(job.paypal_fee) }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Booking fee
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ appendCurrency(job.booking_fee) }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    VAT
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ appendCurrency(job.vat) }}
                                </dd>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="capitalize text-sm font-medium text-gray-500">
                                    Total
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ appendCurrency(job.total) }}
                                </dd>
                            </div>
                        </dl>
                    </template>
                </section-component>

            </div>
        </content-container>
    </app-layout>
</template>

<script>

    import AppLayout from '@/Layouts/AppLayout'
    import ContentContainer from "@/Components/ContentContainer";
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import SectionComponent from "@/Components/Section"
    import Format from "@/Mixins/Format"

    export default {
        name: "Show",
        components: {
            AppLayout,
            ContentContainer,
            JetSectionBorder,
            SectionComponent
        },
        mixins: [
            Format
        ],
        props: ['job']
    }
</script>
