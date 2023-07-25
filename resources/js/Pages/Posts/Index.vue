<template>
<AppLayout>
    <h1>Články <span v-if="tag">: {{ tag }}</span></h1>
    <PostBlock  v-for="post in posts.data" :key="post.id" :post="post" ></PostBlock>
    <Pagination :links="posts.links"></Pagination>
</AppLayout>


</template>



<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import PostBlock from './PostBlock.vue';
    import Pagination from '@/Components/Pagination.vue'


    const props = defineProps({
        posts: Object,
        tag: String
    })


</script>