
<template>
    <AppLayout>
        <h2>Hráči</h2>
        <div v-if="players.data.length>0">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Meno</th>
                        <th>Užívateľ</th>
                        <th>Aktívny</th>
                        <th>možnosti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="player in players.data">
                        <td>{{ player.id }}</td>
                        <td>{{ player.name }}</td>
                        <td>{{ player.user ? player.user.name : '' }}</td>
                        <td>

                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <Link :href="route('player.edit', player.id)" title="upraviť" class="btn btn-sm btn-success">
                                    upraviť
                                </Link>
                                <a v-if="player.deleted_at"  @click.prevent="res(player.id, player.name)" title="obnoviť"  class="btn btn-sm btn-primary">
                                    obnoviť
                                </a>
                                <a v-if="player.deleted_at" @click.prevent="des(player.id, player.name)" title="trvale vymazať"  class="btn btn-sm btn-danger">
                                    trvale vymazať
                                </a>

                                <a v-else :href="route('player.delete', player.id)" @click.prevent="del(player.id, player.name)" title="vymazať"  class="btn btn-sm btn-danger">
                                    vymazať
                                </a>
                            </div>
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
    import { Link, router } from '@inertiajs/vue3';



    const props = defineProps({
        players: Object,
    })

    function del(id, name) {
        if(confirm(`Skutočne chcete vymazať hráča ${name}?`)){
            router.delete(route('player.delete', {player: id}))

        }
    }


    function des(id, name) {
        if(confirm(`Skutočne chcete trvale vymazať hráča ${name}?`)){
            router.delete(route('admin.player.destroy', {player: id}))

        }
    }


    function res(id, name) {
        if(confirm(`Skutočne chcete obnoviť hráča ${name}?`)){
            router.post(route('admin.player.restore', {player: id}))

        }
    }

</script>
