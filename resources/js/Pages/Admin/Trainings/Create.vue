<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                    <li class="breadcrumb-item"><Link :href="route('admin.trainings')">Tréningy</Link></li>
                </ol>
            </nav>
        <h2>Vytvoriť tréningy:</h2>
        <form @submit.prevent="submit" >
            <div class="row">
                <div class="col-md-4">
                    <label for="type" class="form-label">Typ tréningu:</label>
                    <select v-model="form.type" class="form-select"  id="type">
                        <option v-for="(type, index) in training_types" v-key="index" :value="index">{{ type }}</option>
                    </select>
                    <div v-if="errors.type" class="text-danger">
                            {{ errors.type }}
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="place" class="form-label">Miesto tréningu:</label>
                    <select v-model="form.place" class="form-select"  id="type">
                        <option v-for="(place, index) in training_places" v-key="index" :value="index">{{ place }}</option>
                    </select>
                    <div v-if="errors.place" class="text-danger">
                            {{ errors.place }}
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <label for="description" class="form-label">Doplňujúce informácie:</label>
                    <input type="text" class="form-control" id="description" placeholder="doplňujúce informácie o tréningu" v-model="form.description">
                    <div v-if="errors.description" class="text-danger">
                            {{ errors.description }}
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <label for="description" class="form-label">Čas:</label>
                    <input type="time" class="form-control" v-model="form.time">
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label">Dátumy:</label>
                    <input type="date" class="form-control" v-model="sDate" @change="setDate()">
                </div>
            </div>
    
            <div class="row mt-4">
                <div class="col-12">
                    <h3>Tréningy: </h3>
                    <div v-if="errors.dates" class="text-danger">
                            {{ errors.dates }}
                    </div>
                    <div v-for="(d, index) in form.dates">
                        {{ `${new Date(d).getDate()}.${new Date(d).getMonth()}.${new Date(d).getFullYear()} ${new Date(d).getHours()}:${new Date(d).getMinutes()<10 ? '0' : ''}${new Date(d).getMinutes()}`}}
                        <a @click.prevent="remDate(index)" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <button class="btn btn-primary"> Uložiť </button>
                </div>
            </div>
        </form>
    </AppLayout>

    <Head title="vytvoriť tréningy"></Head>


</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm, Head, Link } from '@inertiajs/vue3'

    const props = defineProps({
        training_types: Object,
        training_places: Object,
        errors: Object
    })

    const form = useForm({
        type: 1,
        place: 1,
        dates: [],
        time: "18:00",
        description: null
    })

    var sDate = "";
    const setDate = () => {
        form.dates.push(`${sDate} ${form.time}`)
    }
    const remDate = (index) => {
        form.dates.splice(index, 1); 
    }

    function submit() {
        form.post(route('admin.training.add'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        })
    }





</script>
