<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a :href="route('admin')">Admin</a></li>
            </ol>
        </nav>
        <div class="float-end" v-if="$page.props.auth.permissions.includes('slide-add')">
                <Link :href="route('admin.slide.add')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    pridať slide
                </Link>
            </div>
        <h1>Slides</h1>
        <section class="col-9 mx-auto mb-3">
            <Slider :slides="slides"></Slider>
        </section>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Titulok (link)</th>
                    <th>Obrázok:</th>
                    <th>Aktívny:</th>
                    <th>Pozícia:</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="slide in slides" :key="slide.id">
                    <td>{{ slide.title }} <span v-if="slide.link">(<a :href="slide.link" target="_blank">link</a>)</span></td>
                    <td>
                        <img :src="slide.full_picture_path" style="max-height: 3em;" alt="">
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input  v-if="$page.props.auth.permissions.includes('slide-edit')" class="form-check-input pointer" type="checkbox" role="switch" :id="'slide_'+slide.id" :checked="slide.active" @click="setActive(slide.id)">
                        </div>    
                    
                    </td>
                    <td>
                        <div class="btn-group" role="group" v-if="$page.props.auth.permissions.includes('slide-edit')">
                            <button type="button" class="btn btn-sm btn-success" @click.prevent="setUpPosition(slide.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                    <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                </svg>
                            </button>
                            <span class="btn  btn-sm btn-warning">{{ slide.position }}</span>
                            <button type="button" class="btn btn-sm btn-danger" @click.prevent="setDownPosition(slide.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </button>
                        </div>    
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <Link  v-if="$page.props.auth.permissions.includes('slide-edit')" :href="route('admin.slide.edit', slide.id)" title="upraviť" class="btn btn-sm btn-success">
                                upraviť
                            </Link>
                            <a  v-if="$page.props.auth.permissions.includes('slide-delete')" :href="route('admin.slide.delete', slide.id)" @click.prevent="del(slide.id)" title="vymazať"  class="btn btn-sm btn-danger">
                                vymazať
                            </a>
                        </div>

                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
    <Head :title="Slides" />

</template>



<script setup>
    import { Head, Link } from '@inertiajs/vue3'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Slider from '@/Components/Slide.vue'
    import { router } from '@inertiajs/vue3'

    const props = defineProps({
        slides: Object
    })


    const setActive = (id) => {
        router.get(route('admin.slide.setActive', {slide: id}))
    }

    const setUpPosition = (id) => {
        router.get(route('admin.slide.setUpPosition', {slide: id}))
    }

    const setDownPosition = (id) => {
        router.get(route('admin.slide.setDownPosition', {slide: id}))
    }

    function del(id) {
        if(confirm('Skutočne chcete hráča slide?')){
            router.delete(route('admin.slide.delete', {slide: id}))

        }
    }


</script>