<template>
    <Head :title="this.page.title" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Artigos
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden"
                >
                    <a
                        :href="route('control-panel.articles.index')"
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
                            Listar Artigos
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
                                    {{ this.page.action }} um novo artigo
                                </h2>
                            </header>

                            <form
                                @submit.prevent="saveOrUpdatePublication()"
                                class="mt-6 space-y-6"
                            >
                                <div>
                                    <InputLabel for="name" value="Nome do artigo" />

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
                                            v-model="form.release_id"
                                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        >
                                            <option value="">Selecione</option>

                                            <option
                                                v-for="release in releases"
                                                :key="release.id"
                                                :value="release.id"
                                            >
                                                {{ release.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Autores
                                    </label>
                                    <div
                                        class="
                                            rounded-md border border-gray-300
                                            focus-within:ring-1
                                            focus-within:ring-indigo-600
                                            focus-within:border-indigo-600
                                            overflow-hidden
                                        "
                                    >
                                        <QuillEditor
                                            v-model:content="form.authors"
                                            content-type="html"
                                            theme="snow"
                                            class="bg-white rounded border"
                                        />
                                    </div>
                                </div>


                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Resumo
                                    </label>
                                    <div
                                        class="
                                            rounded-md border border-gray-300
                                            focus-within:ring-1
                                            focus-within:ring-indigo-600
                                            focus-within:border-indigo-600
                                            overflow-hidden
                                        "
                                    >
                                        <QuillEditor
                                            v-model:content="form.resume"
                                            content-type="html"
                                            theme="snow"
                                            class="bg-white rounded border"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Abstract
                                    </label>
                                    <div
                                        class="
                                            rounded-md border border-gray-300
                                            focus-within:ring-1
                                            focus-within:ring-indigo-600
                                            focus-within:border-indigo-600
                                            overflow-hidden
                                        "
                                    >
                                        <QuillEditor
                                            v-model:content="form.abstract"
                                            content-type="html"
                                            theme="snow"
                                            class="bg-white rounded border"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Palavras Chaves
                                    </label>
                                    <div
                                        class="
                                            rounded-md border border-gray-300
                                            focus-within:ring-1
                                            focus-within:ring-indigo-600
                                            focus-within:border-indigo-600
                                            overflow-hidden
                                        "
                                    >
                                        <QuillEditor
                                            v-model:content="form.keywords"
                                            content-type="html"
                                            theme="snow"
                                            class="bg-white rounded border"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        PDF
                                    </label>
                                    <div
                                        class="
                                            rounded-md border border-gray-300
                                            focus-within:ring-1
                                            focus-within:ring-indigo-600
                                            focus-within:border-indigo-600
                                            overflow-hidden
                                        "
                                    >
                                        <input
                                            type="file"
                                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            @change="form.pdf = $event.target.files[0]"
                                        />

                                    </div>

                                    <InputError
                                        :message="this.article?.path"
                                        class="mt-2"
                                    />
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
import {QuillEditor} from "@vueup/vue-quill";

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
        QuillEditor
    },
    props: {
        article: Object,
        releases: Object,
    },
    computed: {

    },
    data() {
        return {
            alert: {
                title: "Artigo salvo com sucesso!",
                message: "Seu Artigo já está diponível no site.",
            },
            page: {
                title: 'Artigos > Criar',
                action: 'Criar ',
            },
            form: useForm({
                id: this.article?.id ?? null,
                release_id: this.article?.release_id ?? null,
                name: this.article?.name ?? '',
                authors: this.article?.authors ?? '',
                resume: this.article?.resume ?? '',
                abstract: this.article?.abstract ?? '',
                keywords: this.article?.keywords ?? '',
                pdf: '',
            }),
            errors: {
                name: ''
            },
            showAlert: false
        }
    },
    mounted() {
        if (this.article) {
            this.page.title = 'Artigos > Editar'
            this.page.action = 'Editar '
            this.alert.title = "Artigo alterado com sucesso!"
            this.alert.message = "A alteração já foi executada."
        }
    },
    methods: {
        saveOrUpdatePublication() {
            const url = this.article
                ? route('control-panel.articles.update', this.article.id)
                : route('control-panel.articles.save')

            const method = this.article ? 'put' : 'post'

            this.form[method](url, {
                preserveScroll: true,
                forceFormData: true,

                onSuccess: () => {
                    if (method === 'post') {
                        this.form.reset()
                        this.$refs.input.value = null
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
