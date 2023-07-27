<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                    <li class="breadcrumb-item"><Link :href="route('admin.trainings')">Tréningy</Link></li>
                </ol>
            </nav>
        <h2>Upraviť tréning:</h2>
        <form @submit.prevent="submit" >
            <div class="row">
                <div class="col-md-4">
                    <label for="type" class="form-label">Dátum a čas:</label>
                    <input type="datetime-local" class="form-control" id="date_time" v-model="form.date_time">
                    <div v-if="errors.date_time" class="text-danger">
                            {{ errors.date_time }}
                    </div>
                </div>
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
                <div class="col-12">
                    <button class="btn btn-primary"> Uložiť </button>
                </div>
            </div>
        </form>
    </AppLayout>

    <Head title="upraviť tréningy"></Head>


</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm, Head, Link } from '@inertiajs/vue3'

    const props = defineProps({
        training: Object,
        training_types: Object,
        training_places: Object,
        errors: Object
    })

    const form = useForm({
        type: props.training.type,
        place: props.training.place,
        date_time: props.training.date_time,      
        description: props.training.description,      
    })

  
    function submit() {
        form.patch(route('admin.training.edit', {training: props.training.id}))
    }





</script>
