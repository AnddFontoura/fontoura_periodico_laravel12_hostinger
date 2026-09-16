<template>
    <Head :title="seo.title">
        <meta name="description" :content="seo.description" head-key="description" />
        <link rel="canonical" :href="seo.url" head-key="canonical" />

        <!-- Open Graph (Facebook, WhatsApp, LinkedIn) -->
        <meta property="og:type" :content="seo.type || 'website'" head-key="og:type" />
        <meta property="og:site_name" :content="seo.siteName" head-key="og:site_name" />
        <meta property="og:title" :content="seo.title" head-key="og:title" />
        <meta property="og:description" :content="seo.description" head-key="og:description" />
        <meta property="og:url" :content="seo.url" head-key="og:url" />
        <meta property="og:image" :content="seo.image" head-key="og:image" />
        <meta property="og:locale" :content="seo.locale || 'pt-BR'" head-key="og:locale" />

        <!-- Twitter / X cards -->
        <meta name="twitter:card" content="summary_large_image" head-key="twitter:card" />
        <meta name="twitter:title" :content="seo.title" head-key="twitter:title" />
        <meta name="twitter:description" :content="seo.description" head-key="twitter:description" />
        <meta name="twitter:image" :content="seo.image" head-key="twitter:image" />

        <!-- Structured data for rich results -->
        <component :is="'script'" type="application/ld+json" v-html="jsonLd" head-key="jsonld" />
    </Head>
</template>

<script>
import { Head } from '@inertiajs/vue3'

export default {
    components: { Head },
    props: {
        seo: {
            type: Object,
            required: true,
        },
    },
    computed: {
        jsonLd() {
            return JSON.stringify({
                '@context': 'https://schema.org',
                '@type': 'WebPage',
                name: this.seo.title,
                description: this.seo.description,
                url: this.seo.url,
                inLanguage: this.seo.locale || 'pt-BR',
                publisher: {
                    '@type': 'Organization',
                    name: this.seo.siteName,
                    logo: {
                        '@type': 'ImageObject',
                        url: this.seo.image,
                    },
                },
            })
        },
    },
}
</script>
