<template>
    <div class="flex">
        <span class="flex items-center border border-r-0 border-gray-300 rounded-l-md shadow-sm px-3">
            <span><slot name="prepend"></slot></span>
        </span>
        <input class="border-l-0 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-r-md shadow-sm flex-1 w-full"
               :type="type"
               :value="value"
               :step="step"
               @input="$emit('input', $event.target.value)"
               ref="input">
    </div>
</template>

<script>
export default {
    props: [
        'value',
        'type',
        'step',
    ],
    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>

