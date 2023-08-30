<template>
    <div class="mx-auto pt-6">
        <h2 class="text-lg">Документы (Файлы)</h2>
    </div>
    <Link :href="route('documents.create')">Создать файл</Link>
    <table>
        <thead>
            <tr>
                <th>Название</th>
                <th>Файл</th>
                <th>Описание</th>
                <th>Манипуляции</th>
            </tr>
        </thead>
        <tbody>
            <!--<tr v-for=""></tr>-->
        </tbody>
    </table>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {
        Link
    },
}
</script>

<style scoped>

</style>
