<template>
    <div>
        <div v-for="(option, i) in optionsArr" class="mb-3">
            <div class="grid grid-cols-6 flex items-center">
                <div class="col-span-4">
                    <jet-label :name="`${type+'-'+option.name}`" :for="`${type+'-'+option.name}`" :value="option.name" class="capitalize text-lg font-medium text-gray-900"></jet-label>
                </div>
                <div class="col-span-2 ml-3" v-if="hasOptions()">
                    <button type="button" class="capitalize focus:outline-none" @click="removeOption(option.id)">
                        <chevron-level></chevron-level>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-6 flex items-center">
            <div class="col-span-4">
                <append-input id="engineer" type="text" class="mt-1 block w-full" v-model="add">
                    <template #prepend>
                        <button type="button" class="h-full capitalize focus:outline-none" @click="addOption()">
                            <plus></plus>
                        </button>
                    </template>
                </append-input>
            </div>
        </div>
    </div>
</template>

<script>

    import JetLabel from "@/Jetstream/Label";
    import JetInput from "@/Jetstream/Input";
    import JetInputError from "@/Jetstream/InputError";
    import JetButton from "@/Jetstream/Button";
    import JetDangerButton from "@/Jetstream/DangerButton";
    import ChevronLevel from "@/Resources/ChevronLevel";
    import AppendInput from "@/Components/AppendInput";
    import Plus from "@/Resources/Plus";

    export default {
        name: "OptionsInput",
        components: {
            JetLabel,
            JetInput,
            JetInputError,
            JetButton,
            JetDangerButton,
            ChevronLevel,
            AppendInput,
            Plus
        },
        props: {
            type: '',
            options: {
                type: Array,
                default: []
            },
        },
        data()
        {
            return {
                optionsArr: {},
                selected: [],
                add: '',
                max_id: 1
            }
        },
        watch: {
            optionsArr(newVal, oldVal)
            {
                this.$emit('returnOptions', newVal);
            }
        },
        methods: {
            addOption()
            {
                this.optionsArr.push({
                    id: ++this.max_id,
                    name: this.add
                });

                this.add = '';
            },
            removeOption(id)
            {
                if(this.hasOptions)
                    this.optionsArr = this.optionsArr.filter(cur => {
                        return cur.id !== id;
                    })
            },
            setMaxID()
            {
                this.max_id = this.optionsArr.reduce((prev, cur) => {
                    return prev.id > cur.id ? prev : cur
                }).id;
            },
            hasOptions()
            {
                return this.optionsArr.length > 1;
            }
        },
        mounted()
        {
            this.optionsArr = JSON.parse(JSON.stringify(this.options));

            this.setMaxID();
        }
    }
</script>

<style scoped>

</style>
