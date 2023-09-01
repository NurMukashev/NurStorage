<script setup>
import { Head } from '@inertiajs/vue3'
import { Link } from "@inertiajs/vue3"
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    file: null
})

defineProps({ errors: Object })

function submit() {
    form.post('/documents')
}

</script>

<template>

    <Head title="Create" />
    <main class="w-1/3 mx-auto p-2">

        <div class="mx-auto pt-6 my-6">
            <h2 class="text-xl text-center font-bold">Создание документа (Файла)</h2>
        </div>
        <div class="mx-auto mb-2 text-orange-600 hover:underline">
            <Link :href="route('documents.index')">Назад</Link>
        </div>

        <p class="text-sm text-left">*Все поля являются обязательными</p>
        <p class="text-sm text-left">*Размер файла не должен превышать 8 мб</p>
        <form @submit.prevent="submit" class="mx-auto flex flex-col justify-around bg-gray-200 p-8">
                <div class="w-full mb-3">
                    <input v-model="form.name" type="text" placeholder="Название" class="w-full" autofocus>
                    <div v-if="errors.name" class="text-red-500">{{ errors.name }}</div>
                </div>
                <div class="w-full mb-3">
                    <input type="file" @input="form.file = $event.target.files[0]" />
                    <div v-if="errors.file" class="text-red-500">{{ errors.file }}</div>
                </div>
                <div class="w-full mb-3">
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </div>
                <div class="w-full mb-3 text-right">
                    <button type="submit" class="ml-auto px-4 py-2 bg-orange-500 hover:bg-orange-700 cursor-pointer text-md font-bold">Создать</button>
                </div>
        </form>

    </main>
</template>

<style scoped>

</style>
