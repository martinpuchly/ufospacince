<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                    <li class="breadcrumb-item"><Link :href="route('admin.trainings')">Tréningy</Link></li>
                </ol>
            </nav>
        <h2 class="mb-4">Účasť na tréningu: {{ training.nicer_date_time }}</h2>

            <div class="row border-bottom mb-2 pb-2" v-for="player in players">
                <div class="col-3">
                    {{ `${player.first_name} ${player.last_name}` }}
                </div>
                <div class="col">
                    <button type="button" class="btn btn-sm mx-2" :class="training_presence_off.includes(player.id) ? 'btn-danger' : ' btn-outline-danger'" @click.prevent="savePresence(player.id, 1)">nezúčastnil sa</button>
                    <button type="button" class="btn btn-sm" :class="training_presence_on.includes(player.id) ? 'btn-success' : ' btn-outline-success'" @click.prevent="savePresence(player.id, 2)">zúčastnil sa</button>
                </div>
            </div>

    </AppLayout>

    <Head title="účasť na tréningu"></Head>


</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head, Link, router } from '@inertiajs/vue3'

    const props = defineProps({
        players: Object,
        training: Object,
        training_presence_off: Array,
        training_presence_on: Array,
        errors: Object
    })

    function savePresence(player, presence)
    {
        router.patch(route('admin.training.presence', { training: props.training, player: player, presence: presence}))
    }

</script>
