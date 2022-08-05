<template>
    <AppLayout>
        <h1>Užívateľia:</h1>
        <div v-if="users.data.length>0">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Meno</th>
                        <th>Email</th>
                        <th>Možnosti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <div class="flex flex-row">
                                <Link :href="route('admin.groups.user', user.id)" title="pridať do skupín">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </Link>
                                <Link :href="route('admin.permissions.user', user.id)" title="pridať povolenia" class="ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                </Link>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination  class="mt-6" :links="users.links"></Pagination>

            </div>
            <span class="text-red-500 font-semibold" v-else>
                Zatiaľ neboli registrovaní žiadni užívateľia.
            </span>


    </AppLayout>
</template>




<script>
import Pagination from '@/Components/Pagination.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3'


export default {
    props:{
        users: Object
    },
    components:{
        AppLayout,
        Link
    }

}
</script>
