<template>
    <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="value" @input="$emit('input', $event.target.value)" ref="input" />
</template>

<script>
    export default {
        name: "TextArea",
        props: ['value'],
        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

<style scoped>
</style>
