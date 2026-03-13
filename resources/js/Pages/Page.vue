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
                    {{ page.name }}
                </h1>
            </div>
            
            <div
                v-html="page.description ?? null"
            >
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
        page: {
            type: Object,
        },
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
