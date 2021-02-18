<template>
    <div class="mw-full overflow-x-auto">
        <div class="table w-full">
            <div class="table-row-group">
                <div class="table-row">
                    <div class="table-cell py-6 px-4 sm:px-6" v-if="hasExport()">
                        <input type="checkbox" name="exports[]" @click ="allExport" v-model="exportAll">
                    </div>
                    <div class="table-cell font-semibold text-xl text-gray-800 leading-tight capitalize py-6 px-4 sm:px-6"
                         v-for="(head, i) in headings"
                         v-if="!isHidden(head) || isHidden(head) && isImage(head)"
                    >
                        <template v-if="!isImage(head)">
                            <template v-if="isSortable(head)">
                                <button class="capitalize focus:outline-none" @click="sortBy = {val: head, direction : !sortBy.direction, date: isDate(head)}">
                                    {{ removeUnderscores(head) }}
                                    <chevron-up v-if="sortBy.val === head && sortBy.direction"></chevron-up>
                                    <chevron-down v-else-if="sortBy.val === head && !sortBy.direction"></chevron-down>
                                    <chevron-level v-else></chevron-level>
                                </button>
                            </template>
                            <template v-else>
                                {{ removeUnderscores(head) }}
                            </template>
                        </template>
                    </div>
                    <div class="table-cell" v-for="action in actions"></div>
                </div>
            </div>

            <div class="table-row-group">
                <div class="table-row" v-for="row in orderedArr">
                    <!-- If not hidden, or hidden but is image -->
                    <div class="table-cell align-middle pb-6 px-4 sm:px-6" v-if="hasExport()">
                        <input type="checkbox" name="exports[]" :value="row.id" v-model="exports">
                    </div>
                    <div class="table-cell align-middle pb-6 px-4 sm:px-6" v-for="(col, j) in row" v-if="!isHidden(j) || isHidden(j) && isImage(j)">
                        <template v-if="isImage(j)">
                        <span class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <img class="h-16 w-16 rounded-full object-cover" :src="col" :alt="col" />
                        </span>
                        </template>
                        <template v-else>
                            {{ col }}
                        </template>
                    </div>
                    <div class="table-cell align-middle pb-6 px-4 sm:px-6" v-if="actions.length > 0">
                        <div class="flex justify-end">
                            <template v-for="action in actions">
                                <template v-if="action === 'delete'">
                                    <jet-danger-button @click.native="confirmDeletion(row.id)" class="ml-3">
                                        {{ action }}
                                    </jet-danger-button>
                                </template>
                                <template v-else-if="action !== 'export'">
                                    <button-link :href="route(model+'.'+action, row.id)" class="ml-3">
                                        {{ action }}
                                    </button-link>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Account Confirmation Modal -->
        <jet-dialog-modal :show="confirmingDeletion" @close="closeModal">
            <template #title>
                Delete {{ model }}
            </template>

            <template #footer>
                <jet-secondary-button @click.native="closeModal">
                    Nevermind
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteSubmit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Delete
                </jet-danger-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>

    import JetDialogModal from "@/Jetstream/DialogModal";
    import JetSecondaryButton from "@/Jetstream/SecondaryButton";
    import JetDangerButton from "@/Jetstream/DangerButton";
    import ButtonLink from "@/Components/ButtonLink";
    import Format from "@/Mixins/Format";
    import ChevronDown from "@/Resources/ChevronDown";
    import ChevronUp from "@/Resources/ChevronUp";
    import ChevronLevel from "@/Resources/ChevronLevel";
    import Search from "@/Components/Search";

    export default {
        name: "Table",
        components: {
            JetDialogModal,
            JetSecondaryButton,
            JetDangerButton,
            ButtonLink,
            ChevronDown,
            ChevronUp,
            ChevronLevel,
            Search
        },
        mixins: [
            Format
        ],
        props: {
            model: '',
            data: {
                type: Array,
                default: []
            },
            hidden: {
                type: Array,
                default: []
            },
            actions: {
                type: Array,
                default: []
            },
            sortable: {
                type: Array,
                default: []
            },
            images: {
                type: Array,
                default: []
            },
            dates: {
                type: Array,
                default: []
            }
        },
        data(){
            return {
                headings: [],
                orderedArr: [],
                sortBy: {
                    val: 'created_at',
                    direction: true, // ASC,
                    date: true
                },
                confirmingDeletion: false,
                form: this.$inertia.form(),
                deleting: '',
                exports: [],
                exportAll: false
            }
        },
        watch: {
            exports(newVal, oldVal)
            {
                this.$emit('returnExport', newVal);
            },
            sortBy(newVal, oldVal)
            {
                this.orderedArr.sort((a, b) => {

                    let val1 = a[newVal.val];
                    let val2 = b[newVal.val];

                    if(newVal.date)
                    {
                        val1 = this.getComparableDate(val1);
                        val2 = this.getComparableDate(val2);
                    }

                    if(newVal.direction)
                    {
                        if(val1 > val2)
                        {
                            return -1;
                        }
                        if(val1 < val2)
                        {
                            return 1;
                        }
                    }else
                    {
                        if(val1 < val2)
                        {
                            return -1;
                        }
                        if(val1 > val2)
                        {
                            return 1;
                        }
                    }


                    return 0;
                });
            },
            data()
            {
                this.getOrder();
            }
        },
        methods: {
            isHidden(key)
            {
                return this.hidden.includes(key);
            },
            isImage(key)
            {
                return this.images.includes(key);
            },
            isSortable(key)
            {
                return this.sortable.includes(key);
            },
            isDate(key)
            {
                return this.dates.includes(key);
            },
            hasExport()
            {
                return this.actions.includes('export');
            },
            getOrder() {
                this.orderedArr = this.data.map(el => {
                    // Convert object to array
                    let obArr = Object.entries(el);

                    obArr.some((el, j) => {
                        // If array contains image
                        this.images.some((image, k) => {
                            if (el.includes(image)) {

                                // Remove it add at to start of array
                                return obArr.unshift(
                                    obArr.splice(j, 1)[0]
                                );
                            }
                        })
                    });

                    // Return to object
                    return Object.fromEntries(obArr);
                });
            },
            getHeadings()
            {
                this.headings = Object.keys(this.orderedArr[0]);
            },
            confirmDeletion(id)
            {
                this.deleting = id;
                this.confirmingDeletion = true;
            },
            deleteSubmit() {
                this.form.delete(route(this.model+'.destroy', this.deleting), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.removeDeleted();
                        this.closeModal();
                    }
                })
            },
            closeModal()
            {
                this.deleting = '';
                this.confirmingDeletion = false;
            },
            removeDeleted()
            {
                this.orderedArr = this.orderedArr.filter(cur => cur.id !== this.deleting);
            },
            allExport()
            {
                if(!this.exportAll)
                    this.exports = this.orderedArr.map(cur => cur.id);
                else
                    this.exports = [];
            }
        },
        mounted() {
            this.getOrder();

            this.getHeadings();
        }
    }
</script>
