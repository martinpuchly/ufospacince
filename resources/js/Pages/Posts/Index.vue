<template>
<AppLayout>
    <h1>Články <span v-if="tag">: {{ `#${tag}` }}</span></h1>
    <PostBlock  v-for="post in posts.data" :key="post.id" :post="post" v-if="posts.data.length"></PostBlock>
    <div v-else class="fs-5 opacity-75">
        Nenašli sa žiadne články {{ tag != undefined ? `s tagom ${tag}` : `` }}.
    </div>
    <br clear="all">
    <Pagination :links="posts.links"></Pagination>
</AppLayout>

<Head>
  <title>Články</title>
  <meta name="description" content="Články na stránke U.F.O. Špačince.">
</Head>

</template>



<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import PostBlock from './PostBlock.vue';
    import Pagination from '@/Components/Pagination.vue'
    import { Head } from '@inertiajs/vue3'


    const props = defineProps({
        posts: Object,
        tag: String
    })


</script>