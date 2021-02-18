<template>
    <div>
        <jet-banner />

        <toast v-if="$page.props.flash" :message="$page.props.flash"></toast>

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center py-3">
                                <inertia-link :href="route('job.index')">
                                    <jet-application-logo class="block h-16 w-auto" />
                                </inertia-link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <!-- Jobs Dropdown -->
                                <div class="hidden sm:flex sm:ml-6 px-1 pt-1">
                                    <div class="ml-3 relative flex">
                                        <div class="inline-flex items-center border-b-2 border-transparent" :class="{'text-gray-900 border-b-2 border-gray-900 focus:border-gray-900': route().current('job.*')}">
                                            <jet-dropdown align="left" width="48">
                                                <template #trigger>
                                                <span class="inline-flex rounded-md">
                                                    <button type="button" :class="{'text-gray-900': route().current('job.*')}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                       Jobs

                                                        <chevron-down></chevron-down>
                                                    </button>
                                                </span>
                                                </template>

                                                <template #content>
                                                    <!-- Account Management -->
                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        Manage Jobs
                                                    </div>

                                                    <jet-dropdown-link :href="route('job.index')">
                                                        All Jobs
                                                    </jet-dropdown-link>

                                                    <jet-dropdown-link :href="route('job.create')">
                                                        Create New Job
                                                    </jet-dropdown-link>
                                                </template>
                                            </jet-dropdown>
                                        </div>
                                    </div>
                                </div>

                                <!-- Users Dropdown -->
                                <div class="hidden sm:flex sm:ml-6 px-1 pt-1">
                                    <div class="ml-3 relative flex">
                                        <div class="inline-flex items-center border-b-2 border-transparent" :class="{'text-gray-900 border-b-2 border-gray-900 focus:border-gray-900': route().current('user.*')}">
                                            <jet-dropdown align="left" width="48">

                                                <template #trigger>
                                                <span class="inline-flex rounded-md">
                                                    <button type="button" :class="{'text-gray-900': route().current('user.*')}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                       Users

                                                        <chevron-down></chevron-down>
                                                    </button>
                                                </span>
                                                </template>

                                                <template #content>
                                                    <!-- Account Management -->
                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        Manage Users
                                                    </div>

                                                    <jet-dropdown-link :href="route('user.index')">
                                                        All Users
                                                    </jet-dropdown-link>

                                                    <jet-dropdown-link v-if="$page.props.user.admin" :href="route('user.create')">
                                                        Create New User
                                                    </jet-dropdown-link>
                                                </template>
                                            </jet-dropdown>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.user.name }}

                                                 <chevron-down></chevron-down>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>

                                        <template v-if="$page.props.user.admin">
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Admin
                                            </div>

                                            <jet-dropdown-link :href="route('admin.edit')">
                                                Admin Panel
                                            </jet-dropdown-link>
                                        </template>

                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <jet-dropdown-link :href="route('profile.show')">
                                            Profile
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                            API Tokens
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                Logout
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">

                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3" >
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">

                            <template v-if="$page.props.user.admin">
                                <jet-responsive-nav-link :href="route('admin.edit')" :active="route().current('admin.edit')">
                                    Admin Panel
                                </jet-responsive-nav-link>

                                <div class="border-t border-gray-100"></div>
                            </template>

                            <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                                Profile
                            </jet-responsive-nav-link>

                            <div class="border-t border-gray-100"></div>

                            <jet-responsive-nav-link :href="route('job.index')">
                                All Jobs
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('job.create')">
                                Create New Job
                            </jet-responsive-nav-link>

                            <div class="border-t border-gray-100"></div>

                            <jet-responsive-nav-link :href="route('user.index')">
                                All Users
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link v-if="$page.props.user.admin" :href="route('user.create')">
                                Create New User
                            </jet-responsive-nav-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    Logout
                                </jet-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>

            <!-- Modal Portal -->
            <portal-target name="modal" multiple>
            </portal-target>
        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo';
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import Toast from "@/Components/Toast";
    import ChevronDown from "@/Resources/ChevronDown";

    export default {
        components: {
            JetApplicationLogo,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Toast,
            ChevronDown
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
