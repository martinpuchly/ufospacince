
<template>
    <AppLayout>
        <div v-if="players.data.length>0">
            <table>
                <thead>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700 inline-block" viewBox="0 0 20 20" fill="currentColor" v-if="player.status">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 inline-block" viewBox="0 0 20 20" fill="currentColor" v-else>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                            </svg>
                        </td>
                        <td>
                            <span>{{ player.user.email }}</span>

                        </td>
                        <td>
                            <div class="flex flex-row">
                                <!--
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
                                -->
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination  class="mt-6" :links="players.links"></Pagination>

            </div>
            <span class="text-red-500 font-semibold" v-else>
                Zatiaľ neboli registrovaní žiadni hráči.
            </span>

    </AppLayout>

</template>




<script>
import Pagination from '@/Components/Pagination.vue'
import AppLayout from '@/Layouts/AppLayout.vue'

    export default{
        props: {
            players: Object
        },
        components: {
            Pagination,
            AppLayout
        }
    }
</script>
