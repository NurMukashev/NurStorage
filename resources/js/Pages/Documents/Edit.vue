<script setup>
import { Head } from '@inertiajs/vue3'
import { Link } from "@inertiajs/vue3"
import { useForm } from '@inertiajs/vue3'
//import { Inertia } from '@inertiajs/inertia' не работает
import { router } from '@inertiajs/vue3'


const props = defineProps({
    errors: Object,
    document_edit: Object
})

const form = useForm({
    name: props.document_edit.name,
    file_name: props.document_edit.file_name,
    file: null
})

function submit() {
    //form.put(route("/documents", props.document_edit.id) //так не получилось
    //form.put('/documents'+ props.document_edit.id) //и так не получилось

    router.put(`/documents/${props.document_edit.id}`, {
        name: form.name,
        file: form.file
    })
}

</script>

<template>

    <Head title="Изменение" />
    <main class="w-1/3 mx-auto p-2">

        <div class="mx-auto pt-6 my-6">
            <h2 class="text-xl text-center font-bold">Изменение документа (Файла)</h2>
        </div>
        <div class="mx-auto mb-2 text-orange-600 hover:underline">
            <Link :href="route('documents.index')">Назад</Link>
        </div>

        <p class="text-sm text-left">*Поле добавления файла является обязательным</p>
        <p class="text-sm text-left">*Размер файла не должен превышать 8 мб</p>

        <form @submit.prevent="submit" class="mx-auto flex flex-col justify-around bg-gray-200 p-8">
                <div class="w-full mb-3">
                    <input v-model="form.name" type="text" placeholder="Название" class="w-full" autofocus>
                    <div v-if="errors.name" class="text-red-500">{{ errors.name }}</div>
                </div>
                <div class="w-full mb-3 px-3 py-2 bg-gray-400">
                    {{ form.file_name }}
                </div>
                <div class="w-full mb-3">
                    <p class="font-bold">Заменить файл:</p>
                    <input type="file" @input="form.file = $event.target.files[0]" />
                    <div v-if="errors.file" class="text-red-500">{{ errors.file }}</div>
                </div>
                <div class="w-full mb-3">
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </div>
                <div class="w-full mb-3 text-right">
                    <button type="submit" class="ml-auto px-4 py-2 bg-orange-500 hover:bg-orange-700 cursor-pointer text-md font-bold">Изменить</button>
                </div>
        </form>

    </main>
</template>

<!--<script>
import {Link} from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
export default {
    name: "Edit",
    components: {
        Link,
        Head
    },

    props: [
        'document_edit',
        'errors'
    ],

    data () {
        return {
            id: this.document_edit.id,
            name: this.document_edit.name,
        }
    },

    methods: {
        update() {
            console.log(this.name);
            this.$inertia.patch(`/documents/${this.id}`,{name: this.name})
        }
    }

}
</script>-->

<style scoped>

</style>
