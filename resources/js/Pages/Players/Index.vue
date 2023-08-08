<template>
    <AppLayout>
        <div class="row">
            <div class="col-sm-9">
                <h1 class="mb-3">Tím:</h1>
                <div class="row">
                        <div class="card mt-5 mx-2" style="width: 18rem;" v-for="player in players.data" v-key="player.id">
                            <div class="position-absolute mx-4 mt-2 fw-bold" style="right:0; font-size: 2em; color:rgba(53,68,110,1)">{{ player.shirt_number }}</div>
                            <Link :href="route('player.show', {player_id: player.id})" class="d-inline">
                                <img :src="player.full_photo_path ? player.full_photo_path : '/images/siluette.png'" class="card-img-top img-fluid mx-1 mt-1" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ player.name }}</h5>
                                </div>
                            </Link>
                        </div>
                </div>
            </div>
            <div class="d-none d-md-block col-sm-3">
                <h3>Štatistiky</h3>
                Aktívny hráči: {{ players.length }}
            </div>
        </div>
    </AppLayout>


    <Head>
          <title>Tím</title>
          <meta name="description" content="Zoznam aktívnych hráčov v našom tíme.">

    </Head>

</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';

    const props = defineProps({
        players: Object
    })


</script>