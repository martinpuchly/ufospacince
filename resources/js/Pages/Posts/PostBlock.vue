<template>
    <div>
        <article class="d-block mb-5">
            <header>
                <h2>{{ post.title }}</h2>
            </header>
            <main v-html="post.intro" style="overflow-wrap: break-word;"></main>
            <div class="w-100" v-if="post.tags">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tags mx-1" viewBox="0 0 16 16">
                <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"/>
                <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>
                </svg>
                <span v-for="(tag, index) in post.tags_array" v-key="index">
                    <Link :href="route('posts', {tag: tag})">#{{ tag }}</Link>, 
                </span>
            </div>
            <footer class="fst-italic border-bottom text-end w-100">
                <div v-if="post.body">
                    <Link :href="route('post', {post_slug: post.slug})">zobraziť celý článok</Link>
                </div>
                <span v-if="post.user_id">publikoval {{ post.user.name }}</span> {{ post.humanize_published_date }}
            </footer>
        </article>

    </div>

</template>


<script setup>
    import { Link } from "@inertiajs/vue3";

    const props = defineProps({
        post: Object
    })


</script>