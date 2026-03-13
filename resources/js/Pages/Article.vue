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
                    px-4
                    py-4
                    bg-white
                    shadow-sm
                    sm:rounded-md
                    dark:bg-gray-800/50
                    dark:shadow-none
                    dark:outline
                    dark:-outline-offset-1
                    dark:outline-white/10
                "
            >
                <h1
                    class="
                        text-2xl/7
                        font-bold
                        text-gray-900
                        dark:text-white
                    "
                >
                    {{ article.name }}
                </h1>
            </div>

            <a :href="this.pdf_url + '/' + article.path" target="_blank">
                <button
                    type="button"
                    class="
                        mt-3
                        bg-emerald-500
                        mb-3
                        px-2
                        py-2
                        w-full
                        shadow-sm
                        sm:rounded-md
                        sm:px-6
                        text-center
                        text-white
                    "
                >
                    Para baixar seu artigo clique aqui
                </button>
            </a>

            <div
                class="
                    mt-3
                    divide-y
                    divide-gray-200
                    overflow-hidden
                    rounded-lg
                    bg-white
                    shadow-sm
                    dark:divide-white/10
                    dark:bg-gray-800/50
                    dark:shadow-none
                    dark:outline
                    dark:-outline-offset-1
                    dark:outline-white/10
                "
            >
                <div
                    class="
                        px-4
                        py-5
                        sm:px-6
                        bg-gray-200
                        font-bold
                    "
                >
                    Autor(es)
                </div>
                <div
                    v-html="article.authors"
                    class="
                        px-4
                        py-5
                        sm:p-6
                        text-justify
                    "
                >
                </div>
            </div>

            <div
                class="
                    mt-3
                    divide-y
                    divide-gray-200
                    overflow-hidden
                    rounded-lg
                    bg-white
                    shadow-sm
                    dark:divide-white/10
                    dark:bg-gray-800/50
                    dark:shadow-none
                    dark:outline
                    dark:-outline-offset-1
                    dark:outline-white/10
                "
            >
                <div
                    class="
                        px-4
                        py-5
                        sm:px-6
                        bg-gray-200
                        font-bold
                    "
                >
                   Resumo
                </div>
                <div
                    v-html="article.resume"
                    class="
                        px-4
                        py-5
                        sm:p-6
                        text-justify
                    "
                >
                </div>
            </div>

            <div
                class="
                    mt-3
                    divide-y
                    divide-gray-200
                    overflow-hidden
                    rounded-lg
                    bg-white
                    shadow-sm
                    dark:divide-white/10
                    dark:bg-gray-800/50
                    dark:shadow-none
                    dark:outline
                    dark:-outline-offset-1
                    dark:outline-white/10
                "
            >
                <div
                    class="
                        px-4
                        py-5
                        sm:px-6
                        bg-gray-200
                        font-bold
                    "
                >
                    Abstract
                </div>
                <div
                    v-html="article.abstract"
                    class="
                        px-4
                        py-5
                        sm:p-6
                        text-justify
                    "
                >
                </div>
            </div>

            <div
                class="
                    mt-3
                    divide-y
                    divide-gray-200
                    overflow-hidden
                    rounded-lg
                    bg-white
                    shadow-sm
                    dark:divide-white/10
                    dark:bg-gray-800/50
                    dark:shadow-none
                    dark:outline
                    dark:-outline-offset-1
                    dark:outline-white/10
                "
            >
                <div
                    class="
                        px-4
                        py-5
                        sm:px-6
                        bg-gray-200
                        font-bold
                    "
                >
                    Palavras Chave
                </div>
                <div
                    v-html="article.keywords"
                    class="
                        px-4
                        py-5
                        sm:p-6
                        text-justify
                    "
                >
                </div>
            </div>
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
        article: {
            type: Object,
        },
        pdf_url: {
            type: String
        }
    },
    data() {
        return {
        }
    },
    computed: {

    },
    methods: {

    }
}
</script>
