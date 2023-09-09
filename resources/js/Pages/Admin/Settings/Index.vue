<template>
    <AppLayout>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                </ol>
            </nav>
            <h1>Nastavenia:</h1>
            <div v-if="settings.length>0">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Titulok</th>
                            <th>Možnosti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="setting in settings" :key="setting.id">
                            <td>{{ setting.title }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                <Link v-if="$page.props.auth.permissions.includes('settings')" :href="route('admin.setting.edit', setting.id)" title="upraviť" class="btn btn-sm btn-success">
                                    upraviť
                                </Link>
                            </div>

                            </td>
                        </tr>
                    </tbody>
                </table>

                </div>
                <span class="text-red-500 font-semibold" v-else>
                    Zatiaľ neboli pridané žiadne nastvenia.
                </span>
            </div>  
    </AppLayout>
</template>




<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link, router } from '@inertiajs/vue3'


    const props = defineProps({
        settings: Object
    })

</script>
