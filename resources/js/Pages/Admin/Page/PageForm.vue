<template>
    <Head :title="this.pageMeta.title" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Páginas
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden"
                >
                    <a
                        :href="route('control-panel.pages.index')"
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
                            Listar Páginas
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
                                    {{ this.pageMeta.action }} uma nova página
                                </h2>
                            </header>

                            <form
                                @submit.prevent="saveOrUpdatePage()"
                                class="mt-6 space-y-6"
                            >
                                <div>
                                    <InputLabel for="name" value="Nome da página" />

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
                                    <label class="block text-sm font-medium text-gray-700">
                                        Conteúdo
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
                                            ref="descriptionEditor"
                                            :content="form.description"
                                            content-type="html"
                                            theme="snow"
                                            class="bg-white rounded border"
                                            @update:content="form.description = $event"
                                        />
                                    </div>

                                    <InputError class="mt-2" :message="errors.description" />
                                </div>

                                <div class="flex items-center gap-2">
                                    <input
                                        id="home_page"
                                        type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                        v-model="form.home_page"
                                    />

                                    <label for="home_page" class="text-sm font-medium text-gray-700">
                                        Definir como página inicial
                                    </label>
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton :disabled="form.processing">{{ this.pageMeta.action }}</PrimaryButton>
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
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from '@inertiajs/vue3'
import Swal from "sweetalert2";
import {QuillEditor} from "@vueup/vue-quill";

export default {
    components: {
        Link,
        PrimaryButton,
        TextInput,
        InputError,
        InputLabel,
        Head,
        AuthenticatedLayout,
        QuillEditor
    },
    props: {
        page: Object,
    },
    data() {
        return {
            alert: {
                title: "Página salva com sucesso!",
                message: "Sua página já está disponível no site.",
            },
            pageMeta: {
                title: 'Páginas > Criar',
                action: 'Criar ',
            },
            form: useForm({
                id: this.page?.id ?? null,
                name: this.page?.name ?? '',
                description: this.page?.description ?? '',
                home_page: !!this.page?.home_page,
            }),
            errors: {
                name: '',
                description: '',
            },
        }
    },
    mounted() {
        if (this.page) {
            this.pageMeta.title = 'Páginas > Editar'
            this.pageMeta.action = 'Editar '
            this.alert.title = "Página alterada com sucesso!"
            this.alert.message = "A alteração já foi executada."

            this.$nextTick(() => {
                this.setEditorContent('descriptionEditor', this.form.description)
            })
        }
    },
    methods: {
        setEditorContent(ref, html) {
            const editor = this.$refs[ref]

            if (editor && html) {
                editor.setHTML(html)
            }
        },
        saveOrUpdatePage() {
            const url = this.page
                ? route('control-panel.pages.update', this.page.id)
                : route('control-panel.pages.save')

            const isUpdate = !!this.page

            this.form.post(url, {
                preserveScroll: true,

                onSuccess: () => {
                    if (!isUpdate) {
                        this.form.reset()
                        this.setEditorContent('descriptionEditor', '')
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

                onError: (errors) => {
                    this.errors.name = errors.name ?? ''
                    this.errors.description = errors.description ?? ''
                }
            })
        }
    },
}
</script>
