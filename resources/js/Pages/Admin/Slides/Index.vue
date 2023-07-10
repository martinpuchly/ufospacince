<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a :href="route('admin')">Admin</a></li>
        </ol>
    </nav>
    <h1>Slides</h1>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Pozícia</th>
                <th>Titulok (link)</th>
                <th>Popis:</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="slide in slides" :key="slide.id">
                <td>{{ slide.position }}</td>
                <td>{{ slide.title }} <span v-if="slide.link">(<a :href="slide.link" target="_blank">link</a>)</span></td>
                <td>{{ slide.description }}</td>
                <td>
                    <Link :href="route('admin.slide.edit', slide.id)" title="upraviť" class="badge text-bg-info col-3 mx-2">
                        upraviť
                    </Link>
                    <Link :href="route('admin.slide.delete', slide.id)" title="vymazať" method="delete" class="badge text-bg-danger col-3 mx-2">
                        vymazať
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>

    <Head :title="Slides" />

</template>



<script setup>
    import { Head, Link } from '@inertiajs/vue3'

    const props = defineProps({
        slides: Object
    })


</script>