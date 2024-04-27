<template>
    <div>
        <div class="flex items-center mb-4">
            <h3 class="text-xl mr-4">Добавить роль</h3>
        </div>
        <div>
            <div class="border border-gray-200 rounded-lg">

                <div>
                    <div class="mb-4" v-if="sections.length > 0">
                        <select @change="getBranches" class="border-gray-300 p-2 w-2/4" v-model="section_id">
                            <option value="null" selected disabled>Выберите раздел</option>
                            <option v-for="section in sections" :value="section.id">{{ section.title }}</option>
                        </select>
                        <div class="text-sm text-red-600" v-if="this.$page.props.errors.section_id">
                            {{ this.$page.props.errors.section_id }}
                        </div>
                    </div>
                    <div class="mb-4" v-if="branches.length > 0">
                        <select class="border-gray-300 p-2 w-2/4" v-model="branch_id">
                            <option value="null" selected disabled>Выберите ветку</option>
                            <option v-for="branch in branches" :value="branch.id">{{ branch.title }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <input type="text" placeholder="Заголовок" v-model="title" class="border-gray-300 p-2 w-2/4">
                        <div class="text-sm text-red-600" v-if="this.$page.props.errors.title">
                            {{ this.$page.props.errors.title }}
                        </div>
                    </div>
                    <div>
                        <a class="block py-2 w-1/4 bg-sky-500 border border-sky-600 text-white text-center"
                            @click.prevent="store" href="#">Добавить</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
export default {
    name: "Create",

    data() {
        return {
            title: '',
            section_id: null,
            branch_id: null,
            branches: []
        }

    },

    props: [
        'sections'
    ],

    methods: {
        store() {
          this.$inertia.post('/admin/roles', {
            title: this.title,
            section_id: this.section_id,
            branch_id: this.branch_id
          })
        },

        getBranches() {
            this.branch_id = null;
            axios.get('/sections/' + this.section_id + '/branches')
                .then(res => {
                    this.branches = res.data;
                })
        }
    },

    components: {

        Link
    },

    layout: AdminLayout
}
</script>

<style scoped></style>
