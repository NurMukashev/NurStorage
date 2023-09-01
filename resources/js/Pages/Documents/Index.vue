<script setup>
    import { Link } from "@inertiajs/vue3";
    import { Head } from "@inertiajs/vue3";

    defineProps({ documents: Object })

</script>

<template>

    <Head title="Список"/>

    <main>
        <div class="mx-auto pt-6 my-6">
            <h2 class="text-xl text-center font-bold">Документы (Файлы)</h2>
        </div>
        <div class="w-3/4 mx-auto text-right mb-4">
            <Link :href="route('documents.create')" class="px-4 py-2 bg-orange-500 hover:bg-orange-700 cursor-pointer text-md font-bold">Создать файл</Link>
        </div>
        <table class="w-3/4 mx-auto text-md table-auto border border-gray-300">
            <thead class="bg-orange-300">
            <tr>
                <th class="border border-gray-300 px-6 py-4">Название</th>
                <th class="border border-gray-300 px-6 py-4">Файл</th>
                <th class="border border-gray-300 px-6 py-4">Манипуляции</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="document in documents">
                <td class="border border-gray-300 px-6 py-4">{{ document.name }}</td>
                <td class="border border-gray-300 px-6 py-4">{{ document.file }}</td>
                <td class="border border-gray-300 px-6 py-4">
                    <Link :href="route('documents.edit', document.id)" class="mx-1 px-3 py-2 bg-orange-500 hover:bg-orange-700 cursor-pointer text-md" >Изменить</Link>
                    <Link :href="route('documents.destroy', document.id)" class="mx-1 px-3 py-2 bg-red-500 hover:bg-red-700 cursor-pointer text-md" >Удалить</Link>
                </td>
            </tr>
            </tbody>
        </table>
    </main>

</template>

<style scoped>

</style>
