<template>
    <div>
        <div class="flex items-center mb-4">
            <h3 class="text-xl mr-4">Статистика</h3>
        </div>
        <div>
            <div v-if="stats" class="flex justify-between text-center">
                <div v-for="stat in stats">
                    <h3>{{ stat.title }}</h3>
                    <p>{{ stat.count }}</p>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
export default {
    name: "Index",

    props: [
    'stats'
    ],
    components: {
        Link
    },

    layout: AdminLayout
}
</script>

<style scoped></style>
