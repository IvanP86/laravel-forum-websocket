<template>
    <div>
        <div class="flex items-center mb-4">
            <h3 class="text-xl mr-4">Личный кабинет</h3>
        </div>

        <div class="bg-white border border-gray-300 p-4">
            <div class="mb-4">
                <p>
                    Приветствую, {{ user.name }}
                </p>
            </div>
            <div class="mb-4">
                <p class="mb-2">
                    Сменить аватар
                </p>
                <a href="#" class="block w-24 h-24 rounded-full bg-gray-300">
                    <img v-if="user.avatar" :src="user.avatar" :alt="user.name">
                </a>
                <div>
                    <input type="file">
                </div>
            </div>            
        </div>
    </div>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
export default {
    name: "Personal",

    props: [
        'user'
    ],


    data() {
        return {
            // content: ''

        }
    },

    components: {
        Link
    },

    layout: MainLayout
}
</script>

<style scoped></style>
