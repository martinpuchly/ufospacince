<template>
    <AppLayout>
        <h1>Tréningy</h1>
         <section class="text-center justify-content-center d-flex px-5">
            <div>
                <Link :href="route('trainings', {date: previousMonth})">
                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                </svg>
                </Link>
            </div>
            <div style="min-width: 25%;">
                <h2>{{ `${month_name} ${year}` }}</h2>
            </div>
            <div>
                <Link :href="route('trainings', {date: nextMonth})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                    </svg>
                </Link>
            </div>
        </section>
        <section v-if="!trainings.length" class="mt-3 fs-4 text-warning">
            Na tento mesiac nie sú naplánované žiadne trénngy.
        </section>
        <section v-else class="mt-3">
            <div v-for="training in trainings" class="border-bottom mb-3 pb-3 rounded p-4" :class="training.passed ? 'opacity-50' : ''">
                <div class="row">
                    <div class="col-lg-5 col-md-6 pr-5">
                        <h3>
                            {{ `${new Date(training.date_time).getDate()}.${new Date(training.date_time).getMonth()+1}.${new Date(training.date_time).getFullYear()}` }}
                            {{ `o ${new Date(training.date_time).getHours()}:${new Date(training.date_time).getMinutes().toString().replace(/^(\d)$/, '0$1')} hod.` }}
                        </h3>
                        <div class="fs-4">
                            <div>Typ: {{ training.value_type }}</div>
                            <div>Miesto: {{ training.value_place }}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div v-if="$page.props.auth.user && $page.props.auth.user.user_level>=2 && !training.passed">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn " :class="player_trainings?.[training.id]==1 ? 'btn-danger' : ' btn-outline-danger'" @click.prevent="savePresence(training.id, 1)">nezúčastním sa</button>
                                <button type="button" class="btn " :class="player_trainings?.[training.id]==2 ? 'btn-success' : ' btn-outline-success'" @click.prevent="savePresence(training.id, 2)">zúčastním sa</button>
                            </div>
                            <div class="mt-2">
                                <Link :href="route('training', {training: training.id})" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                    zobraziť tréning
                                </Link>
                            </div>
                        </div>
                        <div v-if="$page.props.auth.user && $page.props.auth.user.user_level>=2  && training.passed" class="text-secondary">
                            tréning sa už uskutočnil, nie je možné sa na neho prihlásiť
                            <div v-if="$page.props.auth.permissions.includes('training-presence')">
                                <Link :href="route('admin.training.presence', {training: training.id})" class="btn btn-sm btn-info opacity-100">účasť na tréningu</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
    
    <Head>
        <title>Tréningy</title>
        <meta name="description" content="Rozpis tréningov.">
    </Head>

    </template>
    
    
    
    <script setup>
        import AppLayout from '@/Layouts/AppLayout.vue'  
        import { Link, router, Head } from "@inertiajs/vue3";

        const props = defineProps({
            trainings: Object,
            month: Number,
            year: Number,
            month_name: String,
            player_trainings: Array
        })

        function setPreviousMonth (props)  {
            if(props.month==1){
                return `${props.year-1}-12`;
            }
            return `${props.year}-${props.month-1}`;
        }

        function setNextMonth (props)  {
            if(props.month==12){
                return `${Number(props.year)+1}-01`;
            }
            return `${props.year}-${Number(props.month)+1}`;
        }

        const previousMonth = setPreviousMonth(props);
        const nextMonth = setNextMonth(props);

        function savePresence(training, presence)
        {
            router.patch(route('training.savePresence', { training: training, presence: presence}))
        }


    </script>