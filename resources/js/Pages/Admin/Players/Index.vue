
<template>
    <AppLayout>
        <div v-if="players.data.length">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Meno</th>
                        <th>Užívateľ</th>
                        <th>možnosti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="player in players.data" :key="player.id">
                        <td>{{ player.id }}</td>
                        <td>{{ player.name }}</td>
                        <td>{{ player.user ? player.user.name : '' }}</td>
                        <td>
                            <span>{{ player.user.email }}</span>

                        </td>
                        <td>
                            <Link :href="route('admin.groups.user', user.id)" title="pridať do skupín" class="badge text-bg-info inline-block">
                                SKUPINY
                            </Link>
                            <Link :href="route('admin.permissions.user', user.id)" title="pridať povolenia" class="ml-3 badge text-bg-info inline-block">
                                POVOLENIA
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination  class="mt-6" :links="players.links"></Pagination>

        </div>
        <div class="text-red-500 font-semibold" v-else>
            Zatiaľ neboli registrovaní žiadni hráči.
        </div>

    </AppLayout>

</template>




<script setup>
    import Pagination from '@/Components/Pagination.vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        players: Object,
    })

</script>
