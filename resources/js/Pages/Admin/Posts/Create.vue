<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                    <li class="breadcrumb-item"><Link :href="route('admin.posts')">Články</Link></li>
                </ol>
            </nav>
        <h2>Vytvoriť článok:</h2>
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
        errors: Object
    })

    const form = useForm({
        title: null,
        intro: null,
        body: null,
        tags: null,
        published: null,
        published_at: null,
        keywords: null,
        description: null,
    })


    function submit() {
        form.post(route('admin.post.add'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        })
    }





</script>
