<template>
    <AppLayout>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                </ol>
            </nav>
            <div class="float-end">
                <Link :href="route('admin.post.add')" v-if="$page.props.auth.permissions.includes('post-add')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    pridať článok
                </Link>
            </div>
            <h1>Články:</h1>
            <div v-if="posts.length>0">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Titulok</th>
                            <th>Autor</th>
                            <th>Publikované</th>
                            <th>Možnosti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="post in posts" :key="post.id">
                            <td>{{ post.id }}</td>
                            <td>
                                {{ post.title }}
                                <a :href="route('post', {post_slug: post.slug})" target="_blank" title="zobraziť článok" class="mx-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>   
                                </a>
                            </td>
                            <td>{{ post.user.name }}</td>
                            <td>
                                {{ post.readable_published_date }}
                                <svg v-if="post.published" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <Link v-if="!post.deleted_at && $page.props.auth.permissions.includes('post-edit')" :href="route('admin.post.edit', post.id)" title="upraviť" class="btn btn-sm btn-success">
                                    upraviť
                                </Link>
                                <a v-if="post.deleted_at && $page.props.auth.permissions.includes('post-restore')" @click.prevent="res(post.id, post.title)" title="obnoviť"  class="btn btn-sm btn-primary">
                                    obnoviť
                                </a>
                                <a v-if="post.deleted_at && $page.props.auth.permissions.includes('post-destroy')" @click.prevent="des(post.id, post.title)" title="trvale vymazať"  class="btn btn-sm btn-danger">
                                    trvale vymazať
                                </a>
                                <a v-if="!post.deleted_at && $page.props.auth.permissions.includes('post-delete')" :href="route('admin.post.delete', post.id)" @click.prevent="del(post.id, post.title)" title="vymazať"  class="btn btn-sm btn-danger">
                                    vymazať
                                </a>
                            </div>

                            </td>
                        </tr>
                    </tbody>
                </table>

                </div>
                <span class="text-red-500 font-semibold" v-else>
                    Zatiaľ neboli pridané žiadne stránky.
                </span>
            </div>  
    </AppLayout>
</template>




<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link, router } from '@inertiajs/vue3'


    const props = defineProps({
        posts: Object
    })

    function del(id, title) {
        if(confirm(`Skutočne chcete vymazať článok ${title}?`)){
            router.delete(route('admin.post.delete', {post: id}))

        }
    }


    function des(id, title) {
        if(confirm(`Skutočne chcete trvale vymazať článok ${title}?`)){
            router.delete(route('admin.post.destroy', {post_id: id}))

        }
    }


    function res(id, title) {
        if(confirm(`Skutočne chcete obnoviť článok ${title}?`)){
            router.post(route('admin.post.restore', {post_id: id}))

        }
    }


</script>
