<template>
    <main class="mx-auto p-2">

        <h2 class="text-lg text-center m-4">Создание документа (Файла)</h2>

        <form @submit.prevent="store" method="post" enctype="multipart/form-data" class="mx-auto w-1/3 flex flex-col justify-around items-center">
                <div class="w-full mb-3">
                    <input v-model="name" type="text" id="name" placeholder="Название" autofocus>
                </div>
                <div class="w-full mb-3">
                    <input v-model="file" type="file" id="file">
                </div>
                <div class="w-full mb-3">
                    <textarea v-model="text" placeholder="Описание" id="text" cols="30" rows="10"></textarea>
                </div>
                <div class="w-full mb-3">
                    <button type="submit" class="px-2 py-2 bg-orange-500 hover:bg-orange-700 cursor-pointer text-md">Создать</button>
                </div>
        </form>

    </main>
</template>

<script>
export default {
    name: "Index",

    data(){
        return {
            name: '',
            file: '',
            text: '',
        }
    },

    methods:{
        store(){
            this.$inertia.post('/documents', {name: this.name, file: this.file, text: this.text})
        },
    },
}
</script>

<style scoped>

</style>
