<template>
    <SeoHead v-if="seo" :seo="seo" />

    <website-layout>
        <div
            v-html="homePage.description ?? null"
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
        </div>
    </website-layout>
</template>

<script>
import PublicationRightMenu from '@/Components/Publications/PublicationRightMenu.vue'
import WebsiteLayout from "@/Pages/Layouts/WebsiteLayout.vue";
import SeoHead from "@/Components/SeoHead.vue";

export default {
    components: {
        WebsiteLayout,
        PublicationRightMenu,
        SeoHead,
    },
    props: {
        homePage: {
            type: Object,
        },
        seo: {
            type: Object,
            default: null,
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
