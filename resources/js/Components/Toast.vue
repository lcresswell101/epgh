<template>
    <div>
        <transition leave-active-class="transition ease-in duration-1000" leave-class="opacity-100" leave-to-class="opacity-0">
            <div v-show="show" class="toast fixed left-0 bottom-0 right-0 m-6">
                <!-- Success -->
                <div v-if="message.success" class="flex items-center bg-green-700 p-3 shadow-md mb-3">
                    <div class="text-white max-w-xs">
                        {{ message.success }}
                    </div>
                </div>

                <!-- Error -->
                <div v-if="message.error" class="flex items-center bg-red-500 p-3 shadow-md mb-3">
                    <div class="text-white max-w-xs">
                        {{ message.error }}
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "Toast",
        props: {
            'message': {}
        },
        data()
        {
            return {
                show: true
            }
        },
        watch: {
            message: {
                deep: true,
                handler(newVal, oldVal)
                {
                    // If one value isn't null, start toast timer
                    if(!Object.values(newVal).every((val) => val === null))
                    {
                        this.hideToast();
                    }
                }
            }
        },
        methods: {
            hideToast()
            {
                setTimeout(() => this.show = false, 3000);
            }
        }
    }
</script>

<style scoped>

    @media (min-width: 640px)
    {
        .toast
        {
            left: unset;
        }
    }
</style>
