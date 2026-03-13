<template>
    <Head title="Publicações" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Publicações
            </h2>
        </template>

        <div class="py-12">

            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden  mb-3"
                >
                    <a
                        :href="route('control-panel.publications.create')"
                    >
                        <button
                            type="button"
                            class="
                                rounded-md
                                bg-indigo-600
                                px-3.5
                                py-2.5
                                text-sm
                                font-semibold
                                text-white
                                shadow-xs
                                hover:bg-indigo-500
                                focus-visible:outline-2
                                focus-visible:outline-offset-2
                                focus-visible:outline-indigo-600
                                dark:bg-indigo-500
                                dark:shadow-none
                                dark:hover:bg-indigo-400
                                dark:focus-visible:outline-indigo-500
                            "
                        >
                            Criar nova Publicação
                        </button>
                    </a>
                </div>
            </div>

            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <h1
                            class="
                                text-center
                            "
                        >
                            Lista de publicações
                        </h1>
                        <table class="relative min-w-full divide-y divide-gray-300 dark:divide-white/15">
                            <thead>
                            <tr>
                                <th
                                    scope="col"
                                    class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-3 dark:text-white"
                                >
                                    Nome da Publicação
                                </th>

                                <th scope="col" class="py-3.5 pr-4 pl-3 sm:pr-3">
                                    <span class="sr-only">Opções</span>
                                </th>
                            </tr>

                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-gray-200 dark:divide-white/10 dark:bg-gray-900">
                                <tr v-for="publication in publications.data" :key="publication.id" class="even:bg-gray-50 dark:even:bg-gray-800/50">
                                    <td
                                        class="
                                            py-4
                                            pr-3
                                            pl-4
                                            text-sm
                                            font-medium
                                            whitespace-nowrap
                                            text-gray-900
                                            sm:pl-3
                                            dark:text-white
                                        "
                                    >
                                        {{ publication.name }}
                                    </td>

                                    <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-3">
                                        <a :href="route('control-panel.publications.edit', publication.id)">
                                            <button
                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Editar
                                            </button>
    |                                   </a>

                                        <button
                                            @click="confirmDelete(publication.id)"
                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                        >
                                            Deletar
                                        </button >
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="publications.links" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import Swal from "sweetalert2";
import {useForm} from "@inertiajs/vue3";

export default {
    components: {
        Head,
        AuthenticatedLayout,
        Pagination
    },
    props: {
        publications: Object
    },
    data() {
        return {
            form: useForm({
                id: null
            })
        }
    },
    methods: {
        confirmDelete(id) {
            Swal.fire({
                title: "Tem certeza?",
                text: "Essa ação não pode ser desfeita!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim",
                cancelButtonText: "Cancelar",
            }).then(result => {
                if (result.isConfirmed) {
                    let url = route('control-panel.publications.delete', id)
                    let method = 'delete'

                    this.form[method](url, {
                        onSuccess: () => {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Deletado!',
                                showConfirmButton: false,
                                timer: 2500,
                            })
                        },
                    })
                }
            })
        }
    },

}
</script>
