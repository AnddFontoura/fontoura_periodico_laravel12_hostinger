<template>
    <website-layout>
        <div
            class="
                px-4
                sm:px-6
                lg:px-8
                p-4
                flex-1
                order-2
                lg:order-1
                lg:basis-3/4
            "
        >

            <div
                class="
                    mb-3
                    border-black
                "
            >
                <h1
                    class="
                        text-2xl/7
                        font-bold
                        text-gray-900
                        sm:truncate
                        sm:text-3xl
                        sm:tracking-tight
                        dark:text-white
                    "
                >
                    {{ publication.name }}
                </h1>
            </div>

            <ul
                role="list"
                class="
                    space-y-3
                "
            >
                <li
                    v-for="release in this.releases"
                    :key="release.id"
                    class="
                        overflow-hidden
                        bg-white
                        px-4
                        py-4
                        shadow-sm
                        sm:rounded-md
                        sm:px-6
                        dark:bg-gray-800/50
                        dark:shadow-none
                        dark:outline
                        dark:-outline-offset-1
                        dark:outline-white/10
                    "
                >
                    <a
                        :href="'./publications/release/' + release.id"
                        class="
                            block
                            w-full
                            p-0
                            m-0
                            text-2xl/7
                            text-gray-900
                            sm:truncate
                            sm:text-3xl
                            sm:tracking-tight
                            dark:text-white
                        "
                    >
                        {{ release.name }}
                    </a>
                </li>
            </ul>
        </div>
    </website-layout>
</template>

<script>
import PublicationRightMenu from '@/Components/Publications/PublicationRightMenu.vue'
import WebsiteLayout from "@/Pages/Layouts/WebsiteLayout.vue";

export default {
    components: {
        WebsiteLayout,
        PublicationRightMenu,
    },
    props: {
        publication: {
          type: Object,
        },
        releases: {
            type: Object,
        },
    },
    data() {
        return {
        }
    },
    computed() {
    },
    methods: {

    }
}
</script>
