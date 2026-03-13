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
                    {{ release.name }}
                </h1>
            </div>

            <ul
                role="list"
                class="
                    space-y-3
                "
            >
                <li
                    v-for="article in this.articles.data"
                    :key="article.id"
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
                        :href="'/publications/release/article/' + article.id"
                        class="
                            block
                            w-full
                            p-0
                            m-0
                        "
                    >
                        <div
                            class="
                                mt-1
                                text-2xl/7
                                font-bold
                                text-gray-900
                                dark:text-white
                            "
                        >
                            {{ article.name }}
                        </div>

                        <div
                            v-html="article.authors"
                            class="
                                mt-2
                                text-1xl/7
                                text-gray-500
                                dark:text-white
                            "
                        >

                        </div>
                    </a>
                </li>
            </ul>

            <pagination
                :links="articles.links"
            />
        </div>
    </website-layout>
</template>

<script>
import PublicationRightMenu from '@/Components/Publications/PublicationRightMenu.vue'
import WebsiteLayout from "@/Pages/Layouts/WebsiteLayout.vue";
import Pagination from '@/Components/Pagination.vue'

export default {
    components: {
        WebsiteLayout,
        PublicationRightMenu,
        Pagination,
    },
    props: {
        articles: {
            type: Object,
        },
        release: {
            type: Object,
        },
    },
    data() {
        return {
        }
    },
    mounted() {
      console.log(this.articles)
    },
    computed() {
    },
    methods: {

    }
}
</script>
