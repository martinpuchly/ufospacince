<template>
    <AppLayout>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                </ol>
            </nav>
            <div class="float-end">
                <Link :href="route('admin.page.add')" v-if="$page.props.auth.permissions.includes('page-add')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    pridať stránku
                </Link>
            </div>
            <h1>Stránky:</h1>
            <div v-if="pages.length>0">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Titulok</th>
                            <th>URL</th>
                            <th>Zobrazenia</th>
                            <th>Popis</th>
                            <th>Možnosti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="page in pages" :key="page.id">
                            <td>{{ page.id }}</td>
                            <td>{{ page.title }}</td>
                            <td>{{ page.slug }}</td>
                            <td class="col-1 text-center">{{ page.views }}</td>
                            <td>{{ page.description }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <Link v-if="!page.deleted_at && $page.props.auth.permissions.includes('page-edit')" :href="route('admin.page.edit', page.id)" title="upraviť" class="btn btn-sm btn-success">
                                    upraviť
                                </Link>
                                <a v-if="page.deleted_at && $page.props.auth.permissions.includes('page-restore')" @click.prevent="res(page.id, page.title)" title="obnoviť"  class="btn btn-sm btn-primary">
                                    obnoviť
                                </a>
                                <a v-if="page.deleted_at && $page.props.auth.permissions.includes('page-destroy')" @click.prevent="des(page.id, page.title)" title="trvale vymazať"  class="btn btn-sm btn-danger">
                                    trvale vymazať
                                </a>
                                <a  v-if="!page.deleted_at && $page.props.auth.permissions.includes('page-delete')" :href="route('admin.page.delete', page.id)" @click.prevent="del(page.id, page.title)" title="vymazať"  class="btn btn-sm btn-danger">
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
        pages: Object
    })

    function del(id, title) {
        if(confirm(`Skutočne chcete vymazať stránku ${title}?`)){
            router.delete(route('admin.page.delete', {page: id}))

        }
    }


    function des(id, title) {
        if(confirm(`Skutočne chcete trvale vymazať stránku ${title}?`)){
            router.delete(route('admin.page.destroy', {page: id}))

        }
    }


    function res(id, title) {
        if(confirm(`Skutočne chcete obnoviť stránku ${title}?`)){
            router.post(route('admin.page.restore', {page: id}))

        }
    }


</script>
