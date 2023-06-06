<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                <li class="breadcrumb-item"><Link :href="route('admin.groups')">Skupiny</Link></li>
            </ol>
        </nav>
        <Head :title="'povolenia ' + group.name" ></Head>
        <h1>Povolenia skupiny: {{ group.name }}</h1>
            <form @submit.prevent="form.patch(route('admin.permissions.group', group.id))" >
                <div class="row">
                    <div v-for="(permission_group, name) in permissions" class="col">
                        <h2>{{ name }}</h2>
                        <div class="form-check" v-for="permission in permission_group">
                            <input class="form-check-input" type="checkbox" :value="permission.id" :id="'permission_'+permission.id" v-model="form.group_permissions">
                            <label class="form-check-label" :for="'permission_'+permission.id">
                                {{ permission.name }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button
                        type="submit"
                        class="btn btn-primary">
                        Uložiť
                    </button>
                </div>
            </form>
    </AppLayout>
</template>



<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, useForm, Link } from '@inertiajs/vue3'


export default {
    components: {
        AppLayout,
        Head,
        Link
    },
    props:{
        group: Object,
        permissions: Object,
        group_permissions: Array
    },
    setup (props) {
        const form = useForm({
            group_id: props.group.id,
            group_permissions: props.group_permissions,
        })
        return { form }
    }
}
</script>
