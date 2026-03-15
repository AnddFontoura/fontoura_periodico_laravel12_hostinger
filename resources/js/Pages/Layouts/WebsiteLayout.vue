    <template>
        <div>
            <TransitionRoot as="template" :show="this.sidebarOpen">
                <Dialog class="relative z-50 lg:hidden" @close="sidebarOpenValue(false)">
                    <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="" leave="transition-opacity ease-linear duration-300" leave-from="" leave-to="opacity-0">
                        <div class="fixed inset-0 bg-gray-900/80" />
                    </TransitionChild>

                    <div class="fixed inset-0 flex">
                        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                            <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
                                <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="" leave="ease-in-out duration-300" leave-from="" leave-to="opacity-0">
                                    <div class="absolute top-0 left-full flex w-16 justify-center pt-5">
                                        <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpenValue(true)">
                                            <span class="sr-only">Close sidebar</span>
                                            <XMarkIcon class="size-6 text-white" aria-hidden="true" />
                                        </button>
                                    </div>
                                </TransitionChild>

                                <div class="relative flex grow flex-col gap-y-5 overflow-y-auto bg-indigo-600 px-6 pb-4 dark:bg-indigo-800 dark:ring-1 dark:ring-white/10">
                                    <div class="flex h-16 shrink-0 items-center">
                                        <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=white" alt="Your Company" />
                                    </div>
                                    <nav class="flex flex-1 flex-col">
                                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                            <li>
                                                <ul role="list" class="-mx-2 space-y-1">
                                                    <li v-for="page in pages" :key="page.name">
                                                        <a
                                                            :href="'./page/' + page.slug"
                                                            class="
                                                                text-indigo-200
                                                                hover:bg-gray-100
                                                                hover:text-black
                                                                dark:text-indigo-100
                                                                dark:hover:bg-indigo-950/25
                                                                group
                                                                flex
                                                                gap-x-3
                                                                rounded-md
                                                                p-2
                                                                text-sm/6
                                                                font-semibold
                                                            "
                                                        >
                                                            <component :is="page.icon" :class="[page.current ? 'text-white' : 'text-indigo-200 group-hover:text-white dark:text-indigo-100', 'size-6 shrink-0']" aria-hidden="true" />
                                                            {{ page.name }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </Dialog>
            </TransitionRoot>

            <!-- Static sidebar for desktop -->
            <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
                <div
                    class="
                        relative
                        flex
                        grow
                        flex-col
                        gap-y-5
                        overflow-y-auto
                        bg-fontoura
                        px-6
                        pb-4
                        dark:bg-indigo-800
                        dark:after:pointer-events-none
                        dark:after:absolute
                        dark:after:inset-y-0
                        dark:after:right-0
                        dark:after:w-px
                        dark:after:bg-white/10
                    "
                >
                    <div class="flex h-16 shrink-0 items-center">
                        <img class="h-8 w-auto" src="/public/img/logo_fontoura.png" alt="Fontoura Editora" />
                    </div>
                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li v-for="page in pages" :key="page.name">
                                        <a
                                            :href="'./page/' + page.slug"
                                            class="
                                                text-indigo-200
                                                hover:bg-gray-100
                                                hover:text-black
                                                dark:text-indigo-100
                                                dark:hover:bg-indigo-950/25
                                                group
                                                flex
                                                gap-x-3
                                                rounded-md
                                                p-2
                                                text-sm/6
                                                font-semibold
                                            "
                                        >
                                            <component :is="page.icon" :class="[page.current ? 'text-white' : 'text-indigo-200 group-hover:text-white dark:text-indigo-100', 'size-6 shrink-0']" aria-hidden="true" />
                                            {{ page.name }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="lg:pl-72">
                <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-xs sm:gap-x-6 sm:px-6 lg:px-8 dark:border-white/10 dark:bg-gray-900 dark:shadow-none">
                    <button type="button" class="-m-2.5 p-2.5 text-gray-700 hover:text-gray-900 lg:hidden dark:text-gray-400 dark:hover:text-white" @click="sidebarOpenValue(true)">
                        <span class="sr-only">Open sidebar</span>
                        <Bars3Icon class="size-6" aria-hidden="true" />
                    </button>

                    <!-- Separator -->
                    <div class="h-6 w-px bg-gray-900/10 lg:hidden dark:bg-white/10" aria-hidden="true" />

                    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                        <form class="grid flex-1 grid-cols-1" action="#" method="GET">

                        </form>
                        <div class="flex items-center gap-x-4 lg:gap-x-6">
                            BIBLIOTECA DE ARTIGOS CIENTÍFICOS

                            <!-- Separator -->
                            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-900/10 dark:lg:bg-gray-100/10" aria-hidden="true" />

                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative">
                                <MenuButton class="relative flex items-center">
                                    <span class="absolute -inset-1.5" />
                                    <span class="sr-only">Open user menu</span>
                                    <img
                                        v-if="$page.props.auth.user"
                                        class="
                                            size-8
                                            rounded-full
                                            bg-gray-50
                                            outline
                                            -outline-offset-1
                                            outline-black/5
                                            dark:bg-gray-800
                                            dark:outline-white/10
                                        "

                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="" />
                                    <span class="hidden lg:flex lg:items-center">
                                      <span
                                          class="
                                            ml-4
                                            text-sm/6
                                            font-semibold
                                            text-gray-900
                                            dark:text-white
                                          "

                                          aria-hidden="true"
                                      >
                                         {{ $page.props.auth.user ? $page.props.auth.user.name : 'Criar Conta' }}
                                      </span>
                                      <ChevronDownIcon class="ml-2 size-5 text-gray-400 dark:text-gray-500" aria-hidden="true" />
                                    </span>
                                </MenuButton>

                                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems
                                        class="
                                            absolute
                                            right-0
                                            z-10
                                            mt-2.5
                                            w-32
                                            origin-top-right
                                            rounded-md
                                            bg-white
                                            py-2
                                            shadow-lg
                                            outline
                                            outline-gray-900/5
                                            dark:bg-gray-800
                                            dark:shadow-none
                                            dark:-outline-offset-1
                                            dark:outline-white/10
                                        "
                                    >
                                        <MenuItem
                                                v-if="$page.props.auth.user === null"
                                        >
                                            <a
                                                :href="route('register')"
                                                class="
                                                    block
                                                    px-3
                                                    py-1
                                                    text-sm/6
                                                    text-gray-900
                                                    dark:text-white
                                                    hover:bg-gray-500
                                                    hover:text-white
                                                    transition-colors
                                                    duration-150
                                                "
                                            >
                                                Cadastrar
                                            </a>
                                        </MenuItem>

                                        <MenuItem
                                            v-if="$page.props.auth.user === null"
                                        >
                                            <a
                                                :href="route('login')"
                                                class="
                                                    block
                                                    px-3
                                                    py-1
                                                    text-sm/6
                                                    text-gray-900
                                                    dark:text-white
                                                    hover:bg-gray-500
                                                    hover:text-white
                                                    transition-colors
                                                    duration-150
                                                "
                                            >
                                                Logar
                                            </a>
                                        </MenuItem>

                                        <MenuItem
                                            v-if="$page.props.auth.user"
                                        >
                                            <a
                                                :href="route('dashboard')"
                                                class="
                                                    block
                                                    px-3
                                                    py-1
                                                    text-sm/6
                                                    text-gray-900
                                                    dark:text-white
                                                    hover:bg-gray-500
                                                    hover:text-white
                                                    transition-colors
                                                    duration-150
                                                "
                                            >
                                                Painel do Usuario
                                            </a>
                                        </MenuItem>
                                        <MenuItem
                                            v-if="$page.props.auth.user"
                                        >
                                            <a
                                                :href="route('logout')"
                                                class="
                                                    block
                                                    px-3
                                                    py-1
                                                    text-sm/6
                                                    text-gray-900
                                                    text-gray-900
                                                    dark:text-white
                                                    hover:bg-gray-500
                                                    hover:text-white
                                                    transition-colors
                                                    duration-150
                                                "
                                            >
                                                Sair da conta
                                            </a>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </div>

                <main class="py-10">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div
                            class="
                                px-4
                                sm:px-6
                                lg:px-8
                                p-4 flex-1
                                order-1
                                lg:order-2
                                lg:basis-1/4
                            "
                        >
                            <publication-right-menu></publication-right-menu>
                        </div>

                        <slot></slot>
                    </div>
                </main>
            </div>
        </div>
    </template>

    <script>

    import {
        Dialog,
        DialogPanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        TransitionChild,
        TransitionRoot,
    } from '@headlessui/vue'

    import {
        Bars3Icon,
        BellIcon,
        CalendarIcon,
        ChartPieIcon,
        Cog6ToothIcon,
        DocumentDuplicateIcon,
        FolderIcon,
        HomeIcon,
        UsersIcon,
        XMarkIcon,
    } from '@heroicons/vue/24/outline'

    import { ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
    import PublicationRightMenu from '@/Components/Publications/PublicationRightMenu.vue'
    import { usePage } from '@inertiajs/vue3'


    export default  {
        components: {
            PublicationRightMenu,
            Dialog,
            DialogPanel,
            Menu,
            MenuButton,
            MenuItem,
            MenuItems,
            TransitionChild,
            TransitionRoot,
            Bars3Icon,
            BellIcon,
            CalendarIcon,
            ChartPieIcon,
            Cog6ToothIcon,
            DocumentDuplicateIcon,
            FolderIcon,
            HomeIcon,
            UsersIcon,
            XMarkIcon,
            ChevronDownIcon,
            MagnifyingGlassIcon
        },
        props: {
        },
        data() {
            return {
                sidebarOpen: false,
            }
        },
        mounted() {
        },
        computed: {
            pages() {
                return usePage().props.pages
            },
        },
        methods: {
            sidebarOpenValue(value)
            {
                this.sidebarOpen = value
            }
        }
    }
    </script>
