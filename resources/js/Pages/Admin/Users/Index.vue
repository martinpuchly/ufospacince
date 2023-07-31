<template>
    <AppLayout>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                </ol>
            </nav>
            <h1>Užívateľia:</h1>
            <div v-if="users.data.length>0">
                <table class="table table-striped">
                    <thead class="table-dark">
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
                                    <Link v-if="$page.props.auth.permissions.includes('user-groups')" :href="route('admin.groups.user', user.id)" title="pridať do skupín" class="btn btn-sm btn-info col-3 mx-2">
                                        skupiny
                                    </Link>
                                    <Link v-if="$page.props.auth.permissions.includes('user-permissions')"  :href="route('admin.permissions.user', user.id)" title="pridať povolenia" class="btn btn-sm btn-secondary col-3 mx-2">
                                        povolenia
                                    </Link>
                                    <Link v-if="$page.props.auth.permissions.includes('player-add')"  :href="route('admin.player.add', user.id)" title="vytvoriť hráča" class="btn btn-sm btn-warning col-3 mx-2">
                                        vytvoriť hráča
                                    </Link>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :links="users.links"></Pagination>

                </div>
                <span class="text-red-500 font-semibold" v-else>
                    Zatiaľ neboli registrovaní žiadni užívateľia.
                </span>
            </div>  
    </AppLayout>
</template>




<script setup>
    import Pagination from '@/Components/Pagination.vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/vue3'


    const props = defineProps({
        users: Object
    })

</script>
