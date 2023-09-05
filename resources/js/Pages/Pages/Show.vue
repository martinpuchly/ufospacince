<template>
    <AppLayout>
        <article>
            <header>
                <h1>{{ page.title }}</h1>
            </header>
            <main v-html="page.body" style="overflow-wrap: break-word;">

            </main>
        </article>
        <br clear="all">
        <footer class="float-end fst-italic">
            naposedy upravil <span v-if="page.user">{{ page.user.name }}</span> dňa {{ page.humanize_update_date }}
        </footer>
    </AppLayout>

    <Head>
        <title>{{ page.title }}</title>
        <meta v-if="page.description" name="description" :content="page.description">
    </Head>


</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head } from '@inertiajs/vue3'

    const props = defineProps({
        page: Object
    })

</script>