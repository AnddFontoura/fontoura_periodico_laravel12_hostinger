<template>
    <Head :title="this.page.title" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Volumes
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden"
                >
                    <a
                        :href="route('control-panel.releases.index')"
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
                            Listar Volumes
                        </button>
                    </a>
                </div>
            </div>

            <div class="py-12">
                <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                    <div
                        class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                    >
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ this.page.action }} um volume
                                </h2>
                            </header>

                            <form
                                @submit.prevent="saveOrUpdatePublication()"
                                class="mt-6 space-y-6"
                            >
                                <div>
                                    <InputLabel for="name" value="Nome do volume" />

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />

                                    <InputError class="mt-2" :message="errors.name" />
                                </div>

                                <div>
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Publicação
                                        </label>

                                        <select
                                            v-model="form.publication_id"
                                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        >
                                            <option value="">Selecione</option>

                                            <option
                                                v-for="publication in publications"
                                                :key="publication.id"
                                                :value="publication.id"
                                            >
                                                {{ publication.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton :disabled="form.processing">{{ this.page.action }}</PrimaryButton>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import { PhotoIcon } from "@heroicons/vue/16/solid/index.js";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from '@inertiajs/vue3'
import Swal from "sweetalert2";

export default {
    components: {
        Link,
        PrimaryButton,
        DeleteUserForm,
        UpdateProfileInformationForm,
        UpdatePasswordForm,
        TextInput,
        InputError,
        InputLabel,
        PhotoIcon,
        Head,
        AuthenticatedLayout,
        useForm,
    },
    props: {
        publications: Object,
        release: Object,
    },
    computed: {

    },
    data() {
        return {
            alert: {
                title: "Volume salvo com sucesso!",
                message: "Para continuar crie Artigos nesse Volume.",
            },
            page: {
                title: 'Publicações > Criar',
                action: 'Criar ',
            },
            form: useForm({
                id: this.release?.id ?? null,
                publication_id: this.release?.publication_id ?? null,
                name: this.release?.name ?? '',
            }),
            errors: {
                name: ''
            },
        }
    },
    mounted() {
        if (this.publication) {
            this.page.title =  'Volumes > Editar'
            this.page.action = 'Editar '
            this.alert.title = "Volume alterado com sucesso!"
            this.alert.message = "A alteração já foi executada."
        }
    },
    methods: {
        saveOrUpdatePublication() {
            const url = this.publication
                ? route('control-panel.releases.update', this.publication.id)
                : route('control-panel.releases.save')

            const method = this.publication ? 'put' : 'post'

            this.form[method](url, {
                preserveScroll: true,

                onSuccess: () => {
                    if (method === 'post') {
                        this.form.reset()
                    }

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: this.alert.title,
                        text: this.alert.message,
                        showConfirmButton: false,
                        timer: 2500,
                    })
                },

                onFail: (response) => {
                    this.errors.name = response.data;
                }
            })
        }
    },
}
</script>
