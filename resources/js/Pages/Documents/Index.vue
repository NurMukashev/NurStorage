<script setup>
import {Link, router, Head} from "@inertiajs/vue3";
import {ref, watch} from "vue";

    const props = defineProps({
        documents: Object,
        message: String,
        filters: Object,
    })

    let search = ref(props.filters.search);

    watch(search, value => {
        router.get('/documents', { search: value }, {
            preserveState: true,
            replace: true
        });
    });

    const destroy = (id) => {
        if (confirm("Вы точно хотите удалить?")) {
            router.delete(route("documents.destroy", id));
        }
    }

</script>

<template>

    <Head title="Список"/>

    <main>
        <div class="mx-auto pt-6 my-6">
            <h2 class="text-xl text-center font-bold">Документы (Файлы)</h2>
        </div>
        <div v-if="message" class="text-green-600">{{ message }}</div>
        <div class="w-3/4 mx-auto flex justify-between mb-4">
            <p class="font-bold">Общее количество записей: {{ documents.total }}</p>
            <div>
                <input v-model="search" type="text" placeholder="поиск по названию" class="mr-3">
                <Link :href="route('documents.create')" class="px-4 py-3 bg-orange-500 hover:bg-orange-700 cursor-pointer text-md font-bold">Создать файл</Link>
            </div>
        </div>
        <table class="w-3/4 mx-auto text-md table-auto border border-gray-300">
            <thead class="bg-orange-300">
                <tr>
                    <th class="border border-gray-300 px-6 py-4">Название</th>
                    <th class="border border-gray-300 px-6 py-4">Имя файла</th>
                    <th class="border border-gray-300 px-6 py-4">Расширение</th>
                    <th class="border border-gray-300 px-6 py-4">Манипуляции</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="document in documents.data">
                    <td class="border border-gray-300 px-6 py-4">{{ document.name }}</td>
                    <td class="border border-gray-300 px-6 py-4">{{ document.file_name }}</td>
                    <td class="border border-gray-300 px-6 py-4  text-center">
                        {{ document.extension }}
                        <div v-if="document.crop_path" class="mt-2">
                            <img :src="document.crop_path" :alt="'image_' + document.id">
                        </div>
                    </td>
                    <td class="border border-gray-300 px-1 py-2 flex flex-col text-center">
                        <Link :href="route('documents.edit', document.id)" class="mx-1 my-1 px-2 py-1 bg-orange-500 hover:bg-orange-700 cursor-pointer text-md" >изменить</Link>
                        <button @click="destroy(document.id)" class="mx-1 my-1 px-2 py-1 bg-red-500 hover:bg-red-700 cursor-pointer text-md">удалить</button>
                        <a :href="'download/'+ document.id" class="mx-1 my-1 px-2 py-1 bg-red-500 hover:bg-red-700 cursor-pointer text-md">скачать</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="w-3/4 mx-auto my-6 text-center">
            <template v-for="link in documents.links">
                <Link
                    v-if="link.url"
                    :href="link.url"
                    v-html="link.label"
                    class="px-1"
                    :class="{'font-bold' : link.active }"
                />
                <span v-else v-html="link.label" class="text-gray-500 px-1"></span>
            </template>
        </div>

    </main>

</template>

<style scoped>

</style>
