<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                    <li class="breadcrumb-item"><Link :href="route('admin.pages')">Stránky</Link></li>
                </ol>
            </nav>
        <h2>Vytvoriť stránku:</h2>
        <form @submit.prevent="submit" >
            <Form :form="form" :errors="errors" :show_options="show_options"></Form> 
        </form>
    </AppLayout>

    <Head title="vytvoriť stránku"></Head>


</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm, Head, Link } from '@inertiajs/vue3'
    import Form from './Form.vue';

    const props = defineProps({
        show_options: Object,
        errors: Object
    })


    const form = useForm({
        title: null,
        slug: null,
        body: null,
        accessLevel: null,
        description: null,
    })


    function submit() {
        form.post(route('admin.page.add'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        })
    }





</script>
