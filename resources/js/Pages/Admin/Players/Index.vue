
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
                            <Link class="ml-4 btn btn-sm btn-secondary col-md-3 mx-2" :href="route('player.edit', player.id)" title="upraviť hráča" >
                                upraviť
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
