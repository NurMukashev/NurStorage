<script setup>
import { Head } from '@inertiajs/vue3'
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
    <main class="mx-auto p-2">

        <h2 class="text-lg text-center m-4">Создание документа (Файла)</h2>

        <form @submit.prevent="submit" class="mx-auto w-1/3 flex flex-col justify-around items-center">
                <div class="w-full mb-3">
                    <input v-model="form.name" type="text" placeholder="Название" autofocus>
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
                <div class="w-full mb-3">
                    <button type="submit" class="px-2 py-2 bg-orange-500 hover:bg-orange-700 cursor-pointer text-md">Создать</button>
                </div>
        </form>

    </main>
</template>

<style scoped>

</style>
