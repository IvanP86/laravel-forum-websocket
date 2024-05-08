<template>
    <div>
        <div class="bg-white border-b border-gray-300 py-4">
            <div class="w-1/2 mx-auto flex items-center justify-between">
                <div>
                    <Link :href="route('sections.index')" class="mr-4">Forum</Link>
                    <Link :href="route('users.personal')" class="mr-4">Личный кабинет</Link>
                    <Link :href="route('admin.main.index')">Админка</Link>
                </div>
                <div class="w-1/4 text-right">
                    <div class="relative">
                        <a @click.prevent="openNotification" href="#">
                            <span class="mr-2">Оповещения</span>
                            <span>{{ this.$page.props.auth.notifications_count }}</span>
                        </a>
                        <div v-if="this.$page.props.auth.notifications.length > 0 && isOpen" class="absolute w-full">
                            <div v-for="notification in this.$page.props.auth.notifications"
                                class="p-4 border border-b border-gray-300 bg-white text-left">
                                <p>{{ notification.title }}</p>
                                <Link class="text-sky-600" :href="notification.url">Перейти</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/2 mx-auto py-4">
            <slot />
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    name: "MainLayout",

    created() {
        window.Echo.channel('test-name')
            .listen('.test', res => {
                console.log(res)
            })
    },

    data() {
        return {
            isOpen: false
        }
    },

    methods: {
        openNotification() {
            this.isOpen = !this.isOpen
            let ids = this.$page.props.auth.notifications.map(notification => {
                return notification.id
            })
            axios.patch('/notifications/update_collection', {
                ids: ids
            }).then( res => {
                this.$page.props.auth.notifications_count = res.data.count
            })
        }
    },

    components: {
        Link
    }
}
</script>

<style scoped></style>
