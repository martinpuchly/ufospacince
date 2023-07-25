<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                    <li class="breadcrumb-item"><Link :href="route('admin.posts')">Články</Link></li>
                </ol>
            </nav>
            <div class="float-end">
            <a :href="route('post', {post_slug: post.slug})" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg>   
                zobraziť článok
            </a>
        </div>
        <h2>Upraviť článok:</h2>
        <form @submit.prevent="submit" >
            <Form :form="form" :errors="errors"></Form> 
        </form>
    </AppLayout>

    <Head title="vytvoriť stránku"></Head>


</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm, Head, Link } from '@inertiajs/vue3'
    import Form from './Form.vue';

    const props = defineProps({
        post: Object,
        errors: Object
    })

    const form = useForm({
        title: props.post.title,
        intro: props.post.intro,
        body: props.post.body,
        tags: props.post.tags,
        published: props.post.published == 1 ? true : false,
        published_at: props.post.published_at,
        keywords: props.post.keywords,
        description: props.post.description,
    })


    function submit() {
        form.patch(route('admin.post.edit', {post: props.post.id}));
    }





</script>
