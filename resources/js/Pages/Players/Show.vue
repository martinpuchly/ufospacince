<template>
    <AppLayout>
        <h2>{{ player.data.name }}</h2>
        <div class="row">
            <div class="col-sm-9">
                <table class="table">
                    <tbody>
                        <tr v-if="player.data.first_name">
                            <td>Meno: </td>
                            <td>{{ player.data.first_name }}</td>
                        </tr>
                        <tr v-if="player.data.last_name">
                            <td>Priezvisko: </td>
                            <td>{{ player.data.last_name }}</td>
                        </tr>    
                        <tr v-if="player.data.nickname">
                            <td>Prezývka: </td>
                            <td>{{ player.data.nickname }}</td>
                        </tr>
                        <tr v-if="player.data.birth_date">
                            <td>Vek: </td>
                            <td>{{ player.data.birth_date }}</td>
                        </tr>
                        <tr v-if="player.data.age">
                            <td>Vek: </td>
                            <td>{{ player.data.age }} rokov</td>
                        </tr>
                        <tr v-if="player.data.shirt_number">
                            <td>Číslo dresu: </td>
                            <td>{{ player.data.shirt_number }} rokov</td>
                        </tr>
                        <tr v-if="player.data.user">
                            <td>Užívateľ: </td>
                            <td>{{ player.data.user }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-3">
                <img :src="player.data.photo ? player.data.photo : '/images/siluette.png'" alt="" class="img-fluid">
            </div>
        </div>
        <div class="row" v-if="player.data.about">
            <div class="col-12">
                <h3>O mne</h3>
                {{ player.data.about }}
            </div>
        </div>
    </AppLayout>

    <Head>
        <title>{{ player.data.name }}</title>
        <meta name="description" :content="`profil hráča ${player.data.name}`">
    </Head>
</template>



<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Head } from '@inertiajs/vue3'

    const props = defineProps({
        player: Object,
    })


</script>