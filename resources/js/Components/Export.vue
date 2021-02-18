<template>
    <div v-if="hasExport()">
        <a :href="route(model+'.export', {
            jobs: formatExports
        })"
           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 xl:ml-3">
            Export
        </a>
    </div>
</template>

<script>

    import ButtonLink from "@/Components/ButtonLink";
    export default {
        name: "Export",
        components: {
            ButtonLink
        },
        props: {
            model: '',
            actions: {
                type: Array,
                default: []
            },
            exports: {}
        },
        computed: {
            formatExports()
            {
                return this.exports.join(',');
            }
        },
        methods: {
            hasExport()
            {
                return this.actions.includes('export') && this.exports.length > 0;
            }
        }
    }
</script>

<style scoped>

</style>
