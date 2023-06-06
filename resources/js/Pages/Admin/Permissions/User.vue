<template>
    <AppLayout>
        <Head :title="'povolenia ' + user.name" ></Head>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                <li class="breadcrumb-item"><Link :href="route('admin.users')">Používateľia</Link></li>
            </ol>
        </nav>
        <h1>Povolenia: {{ user.name }}</h1>
            <form @submit.prevent="form.patch(route('admin.permissions.user', user.id))" >
                <div class="flex flex-wrap">
                    <div v-for="(permission_group, name) in permissions" class="w-1/4 ml-10 mb-20">
                        <h2>{{ name }}</h2>
                        <div class="form-check" v-for="permission in permission_group">
                            <input class="form-check-input" type="checkbox" :value="permission.id" :id="'permission_'+permission.id" v-model="form.user_permissions">
                            <label class="form-check-label" :for="'permission_'+permission.id">
                                {{ permission.name }}
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-5 mt-5"> Uložiť </button>
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
        user: Object,
        permissions: Object,
        user_permissions: Array
    },
    setup (props) {
        const form = useForm({
            user_id: props.user.id,
            user_permissions: props.user_permissions,
        })
        return { form }
    },
    methods: {

    },
    mounted(props) {
        console.log(props);
    },
}
</script>
