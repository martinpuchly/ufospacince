<template>
    <AppLayout>
        <header>
            <h1>{{ post.title }}</h1>
        </header>
        <main>
            <section v-html="post.intro" style="overflow-wrap: break-word;"></section>
            <br clear="all">
            <section v-if="post.body" v-html="post.body" style="overflow-wrap: break-word;"></section>
        </main>
        <br clear="all">
        <footer class="w-100 border-top">
            <section v-if="post.tags">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tags mx-1" viewBox="0 0 16 16">
                <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"/>
                <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>
                </svg>
                <span v-for="(tag, index) in post.tags_array" v-key="index">
                    <Link :href="route('posts', {tag: tag})">#{{ tag }}</Link>, 
                </span>
            </section>
            <section class="float-end">
                publikoval {{ post.user.name }} {{ post.humanize_published_date }}
            </section>
        </footer>
    </AppLayout>


    <Head>
          <title>{{ post.title }}</title>
          <meta v-if="post.keywords" name="keywords" :content="post.keywords">
          <meta v-if="post.description" name="description" :content="post.description">

    </Head>

</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';

    const props = defineProps({
        post: Object
    })


</script>