<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                </ol>
            </nav>
            <div class="float-end" v-if="$page.props.auth.permissions.includes('training-add')">
                <div class="mb-2">
                    <Link :href="route('admin.training.add')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    pridať tréning
                </Link>
                </div>
                <div>
                    <Link :href="route('admin.trainings')">nasledujúce</Link>
                        <span> | </span>
                    <Link :href="route('admin.trainings', {q: 1})">všetky</Link>
                </div>
            </div>
        <h2>Tréningy:</h2>
        <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Kedy: </th>
                            <th>Kde: </th>
                            <th>Typ: </th>
                            <th>Možnosti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="training in trainings.data">
                            <td>{{ training.id }}</td>
                            <td>{{ training.nicer_date_time }}</td>
                            <td>{{ training.value_place }}</td>
                            <td>{{ training.value_type }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <Link v-if="training.passed && $page.props.auth.permissions.includes('training-presence')" :href="route('admin.training.presence', training.id)" title="účasť" class="btn btn-sm btn-info">
                                        účasť na tréningu
                                    </Link>
                                    <Link v-if="$page.props.auth.permissions.includes('training-edit')" :href="route('admin.training.edit', training.id)" title="upraviť" class="btn btn-sm btn-success">
                                        upraviť
                                    </Link>
                                    <a v-if="$page.props.auth.permissions.includes('training-destroy')" :href="route('admin.training.delete', training.id)" @click.prevent="del(training.id, training.nicer_date_time)" title="vymazať"  class="btn btn-sm btn-danger">
                                        vymazať
                                    </a>
                                </div>
                                                       
                            </td>
                        </tr>
                    </tbody>
                </table>

    </AppLayout>

    <Head title="vytvoriť tréningy"></Head>


</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm, Head, Link, router} from '@inertiajs/vue3'

    const props = defineProps({
        trainings: Object,
        training_types: Array,
        training_places: Array
    })
   
    function del(id, date_time) {
        if(confirm(`Skutočne chcete vymazať tréning ${date_time}?`)){
            router.delete(route('admin.training.delete', {training: id}))

        }
    }


</script>
