<template>
    <div class="flex">
        <input :class="{ 'border-r-0 rounded-l-md' : value, 'rounded-md' : !value}" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm flex-1 w-full"
               :type="type"
               :value="value"
               @input="$emit('input', $event.target.value)"
               ref="input">
        <span v-if="value" class="flex border border-l-0 border-gray-300 rounded-r-md shadow-sm px-3">
            <span><slot name="prepend"></slot></span>
        </span>
    </div>
</template>

<script>
export default {
    props: [
        'value',
        'type',
    ],
    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>

