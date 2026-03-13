<template>
    <h1>Publicações</h1>
    <ul
        role="list"
        class="mt-2 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-3 gap-2"
    >
        <li v-for="publication in this.publications" :key="publication.id">
            <a :href="'/publications/' + publication.id">
                <button
                    class="
                        w-full
                        flex
                        items-center
                        justify-center
                        rounded-md
                        bg-gray-200
                        p-3
                        text-sm
                        font-semibold
                        text-gray-800
                        hover:bg-fontoura
                        hover:text-white
                        dark:bg-gray-800
                        dark:text-indigo-100
                        dark:hover:bg-indigo-950/25
                    "
                >
                    {{ publication.name }}
                </button>
            </a>
        </li>
    </ul>
</template>

<script>
import { usePage } from '@inertiajs/vue3'

export default {
    computed: {
        publications() {
            return usePage().props.publications
        }
    }
}
</script>

