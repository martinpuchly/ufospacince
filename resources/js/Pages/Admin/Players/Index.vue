
<template>
    <AppLayout>
        <div v-if="players.data.length>0">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Meno</th>
                        <th>Užívateľ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="player in players.data" :key="player.id">
                        <td>{{ player.id }}</td>
                        <td>{{ player.full_name }} 

                        </td>
                        <td>
                            <span>{{ player.user.email }}</span>

                        </td>
                        <td>
                            <Link :href="route('admin.groups.user', user.id)" title="pridať do skupín" class="btn btn-sm btn-info inline-block">
                                SKUPINY
                            </Link>
                            <Link :href="route('admin.permissions.user', user.id)" title="pridať povolenia" class="ml-3" class="btn btn-sm btn-info inline-block">
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


    const props = defineProps([
        players: Object
    ])

</script>
