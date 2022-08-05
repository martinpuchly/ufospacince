<template>
    <AppLayout>
        <h1>Vytvoriť profil hráča</h1>
        <h3>Užívateľ: {{ user.name }}</h3>
        <form @submit.prevent="form.post(route('admin.player.add', user.id))" class="w-full">
            <div class="flex flex-col sm:flex-row">
                <div>
                    <div>
                        <label for="first_name" class="w-1">Meno: </label>
                    </div><div>
                        <input type="text" v-model="form.first_name" id="first_name">
                        <div v-if="form.errors.first_name" class="text-danger">{{ form.errors.first_name }}</div>
                    </div>
                </div>
                <div class="ml-4">
                    <div>
                        <label for="last_name">Priezvisko: </label>
                    </div>
                    <div>
                        <input type="text" v-model="form.last_name" id="last_name">
                        <div v-if="form.errors.last_name" class="text-danger">{{ form.errors.last_name }}</div>
                    </div>
                </div>

            </div>

                <button type="submit" class="btn btn-primary "> Požiadať </button>            
            </form>
        
    </AppLayout>
</template>




<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    props: {
        user: Object,
        errors: Object
    },
    components:{
        AppLayout
    },
    setup(props) {
        const form = useForm({
            first_name: "",
            last_name: "",
            user_id: props.user.id
        })
        return { form }
    }
        
    



}
</script>