<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a :href="route('admin')">Admin</a></li>
                <li class="breadcrumb-item"><a :href="route('admin.slides')">Slidy</a></li>
            </ol>
        </nav>
    <h1>Vytvoriť slide: </h1>
        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="title" class="form-label">Titulok:</label>
                <input type="text" class="form-control" id="title" placeholder="titulok" v-model="form.title">
                <div v-if="errors.title" class="text-danger">
                    {{ errors.title }}
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Podtitulok:</label>
                <input type="text" class="form-control" id="description" placeholder="podtitulok" v-model="form.description">
                <div v-if="errors.description" class="text-danger">
                    {{ errors.description }}
                </div>
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">URL link:</label>
                <input type="text" class="form-control" id="link" placeholder="link" v-model="form.link">
                <div v-if="errors.link" class="text-danger">
                    {{ errors.link }}
                </div>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Pozícia:</label>
                <input type="number" class="form-control" id="position" placeholder="pozícia" v-model="form.position">
                <div v-if="errors.position" class="text-danger">
                    {{ errors.position }}
                </div>
            </div>

            <div class="mb-3">
                    <label for="image" class="form-label">Obrázok</label>
                    <input type="file" @input="form.image = $event.target.files[0]" class="form-control" accept="image/png, image/jpeg">/>
                    <div v-if="errors.image" class="text-danger">
                            {{ errors.image }}
                    </div>
                </div>               

            <div class="mb-3">
                <input class="form-check-input" type="checkbox" v-model="form.active" id="active" checked>
                <label class="form-check-label" for="active">
                        Aktívny?
                </label>
                <div v-if="errors.active" class="text-danger">
                        {{ errors.active }}
                </div>
            </div>               
            <button type="submit" class="btn btn-primary">Pridať slide</button>        
        </form>
</AppLayout>

</template>



<script setup>

    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';


    const props = defineProps({
        errors: Object
    })

    const form = useForm({
            title: null,
            description: null,
            link: null,
            number: null,
            image: null,
            position: null

        })



    const submit = () => {
        form.post(route('admin.slide.add'));
    }


</script>
