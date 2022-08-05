<template>
<Head title="upraviť skupinu" />
    <AppLayout>
            <h2>Upraviť skupinu: </h2>
                <form @submit.prevent="form.patch(route('admin.group.edit', group.id))" >
                    <div class="form-group">
                        <label for="name">Názov skupiny: </label>
                        <input type="text" v-model="form.name" id="name">
                        <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
                    </div>
                    <div class="form-group">
                        <label for="description">Popis skupiny: </label>
                        <input type="text" v-model="form.description" id="description">
                        <div v-if="form.errors.description">{{ form.errors.description }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary ">uložiť</button>            
                </form>
    </AppLayout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components:{
        AppLayout,
        Head,
    },
    props: {
        group: Object,
        errors: Object,
    },
    setup (props) {
        const form = useForm({
            id: props.group.id,
            name: props.group.name,
            description: props.group.description,
        })
        return { form }
    },

}
</script>