<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                <li class="breadcrumb-item"><Link :href="route('admin.users')">Používateľia</Link></li>
            </ol>
        </nav>
        <h1>Priradenie skupín: {{ user.name }}</h1>
        <form  @submit.prevent="form.patch(route('admin.groups.user', user.id))">
            <div class="form-check" v-for="group in groups" :key="group.id">
                <input class="form-check-input" type="checkbox" :value="group.id" :id="'group_'+group.id" v-model="form.user_groups">
                <label class="form-check-label" :for="'group_'+group.id">
                    {{ group.name }}
                </label>
            </div>
        <button type="submit" class="btn btn-primary mt-3 ml-4">Uložiť</button>
        </form>
    </AppLayout>
</template>


<script>
import { reactive } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';


export default {
    props: {
        groups: Object,
        errors: Object,
        user_groups: Array,
        user: Object
    },
    setup (props) {
        const form = useForm({
            user_id: props.user.id,
            user_groups: props.user_groups,
        })
        return { form }
    },
    components:{
        AppLayout,
        Link
    },
    mounted(props) {
        console.log(props);
    },
}
</script>