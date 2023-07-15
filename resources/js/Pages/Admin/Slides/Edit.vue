<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a :href="route('admin')">Admin</a></li>
                <li class="breadcrumb-item"><a :href="route('admin.slides')">Slidy</a></li>
            </ol>
        </nav>

       <h2>Upraviť slide: </h2>
        <h3>Náhľad: </h3>
        <div id="carouselExampleCaptions" class="carousel slide carousel-fade col-9 mx-auto" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" v-for="(item, index) in slides" data-bs-target="#carouselExampleCaptions" :data-bs-slide-to="index" :class="index==0 ? 'active' : ''" :aria-current="index==1 ? 'true' : ''" :aria-label="'Slide'+item.id"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" style="height: 25em">
                <img :src="slide.full_picture_path" class="d-block w-100" style="height: 100%; object-fit: cover;" alt="">
                <div class="carousel-caption d-none d-md-block">
                    <a v-if="slide.link" :href="slide.link" style="color:white">
                        <h5 style="color:white; font-size: 1.5rem;">{{ slide.title }}</h5>
                    </a>
                    <h5 v-else style="color:white; font-size: 1.5rem;">{{ slide.title }}</h5>

                    <p v-if="slide.description">{{ slide.description }}</p>
                </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

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
                    <label for="picture" class="form-label">Obrázok</label>
                    <input type="file" name="picture" @input="form.picture = $event.target.files[0]" class="form-control"/>
                    <div v-if="errors.picture" class="text-danger">
                        {{ errors.picture }}
                    </div>
                </div>               

            <div class="mb-3">
                <input class="form-check-input" type="checkbox" v-model="form.active" id="active" :checked="slide.active"> 
                <label class="form-check-label px-1" for="active">
                     aktívny?
                </label>
                <div v-if="errors.active" class="text-danger">
                    {{ errors.active }}
                </div>
            </div>
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
              </progress>          
            <button type="submit" class="btn btn-primary">Uložiť slide</button>        
        </form>
</AppLayout>
<Head title="upraviť slider" />

</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm, Head } from '@inertiajs/vue3';

    const props = defineProps({
        slide: Object,
        errors: Object
    })

    const form = useForm({
        _method: 'patch',
        title: props.slide.title,
        description: props.slide.description,
        link: props.slide.link,
        active: props.slide.active,
        picture: null,
    })

    function submit() {
        console.log(form)
        form.post(route('admin.slide.edit', {slide: props.slide.id}))
    }



</script>
