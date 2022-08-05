<template>
    <AppLayout>
        <Link :href="route('admin.users')" title="užívateľia">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
            </svg>
        </div>

        
        </Link>
        <h1>Priradenie skupín: {{ user.name }}</h1>
        <form  @submit.prevent="form.patch(route('admin.groups.user', user.id))">
        <div v-for="group in groups" :key="group.id">
            <div class="form-group">
                <input type="checkbox" :value="group.id" :id="'group_'+group.id" v-model="form.user_groups"><label :for="'group_'+group.id" class="ml-2">{{ group.name }}</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 ml-4">Uložiť</button>
        </form>
    </AppLayout>
</template>


<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';


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