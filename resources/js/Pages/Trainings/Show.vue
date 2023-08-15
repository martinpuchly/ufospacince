<template>
    <AppLayout>
        <h1>Tréning:</h1>
        <h2>
            {{ date_time_nice + `, ${training.value_type}, ${training.value_place}` }} 
        </h2>
        <section class="row">
            <div class="col-4 fs-4">
                <div>Zúčastí sa: {{ players_num_on }} hráčov</div>
                <div>Nezúčastí sa: {{ players_num_off  }} hráčov</div>
            </div>
            <div class="col-6 fs-5 fst-italic" v-if="training.description">
                <span class="fw-bold">Info: </span>{{ training.description  }}
            </div>
        </section>
        <section class="row mt-4">
            <div class="col-4 text-success">
                <h3 class="text-success">Zúčastní sa: </h3>
                <ul v-if="players_on.data.length">
                    <li v-for="player in players_on.data">{{ player.name }}</li>
                </ul>
                <div v-else class="text-secondary opacity-75">
                    Nikto s viditelným profilom sa zatiaľ účasť na tréningu nepotvrdil.
                </div>
            </div>
            <div class="col-4 text-danger">
                <h3 class="text-danger">Nezúčastní sa: </h3>
                <ul v-if="players_off.data.length">
                    <li v-for="player in players_off.data">{{ player.name }}</li>
                </ul>
                <div v-else class="text-secondary opacity-75"> 
                    Nikto s viditelným profilom zatiaľ NEúčasť na tréningu nepotvrdil.
                </div>
            </div>
        </section>
        
    </AppLayout>
    <Head>
        <title>Tréning {{ date_time_nice }}</title>
        <meta name="description" content="Your page description">
    </Head>
    
    </template>
    
    
    
    <script setup>
        import AppLayout from '@/Layouts/AppLayout.vue'  
        import { Head } from "@inertiajs/vue3";

        const props = defineProps({
            training: Object,
            players_num_on: Number,
            players_num_off: Number,
            players_on: Object,
            players_off: Object,

        })

        const date_time_nice = `${new Date(props.training.date_time).getDate()}.${new Date(props.training.date_time).getMonth()+1} ${new Date(props.training.date_time).getFullYear()}` +
            ` o ${new Date(props.training.date_time).getHours()}:${new Date(props.training.date_time).getMinutes().toString().replace(/^(\d)$/, '0$1')} hod.`;

    </script>