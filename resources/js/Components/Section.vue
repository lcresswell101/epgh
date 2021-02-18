<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <jet-section-title>
            <template #title><slot name="title"></slot></template>
            <template #description><slot name="description"></slot></template>
        </jet-section-title>

        <div class="mt-5 md:mt-0 md:col-span-2">
           <slot name="content"></slot>
        </div>
    </div>
</template>

<script>

    import JetSectionTitle from '@/Jetstream/SectionTitle'

    export default {
        name: "Section",
        components: {
            JetSectionTitle
        }
    }
</script>

<style scoped>

</style>
