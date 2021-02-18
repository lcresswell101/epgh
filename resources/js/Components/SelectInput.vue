<template>
    <select @input="$emit('input', $event.target.value)" class="capitalize border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        <option :value="option.id" v-for="(option, i) in options" :selected="selected === option.id">
            {{ option.name }}
        </option>
    </select>
</template>

<script>


    export default {
        name: "SelectInput",
        props: {
            options: {},
            selected: ''
        }
    }
</script>

<style scoped>

</style>
