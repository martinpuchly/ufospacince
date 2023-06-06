<template>
    <AppLayout>
        <h1>Vytvoriť profil hráča</h1>
        <h3>Užívateľ: {{ username }}</h3>
        <form @submit.prevent="submit" >
            <div class="row">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">Meno</label>
                    <input type="text" class="form-control" id="first_name" placeholder="Meno" v-model="form.first_name">
                    <div v-if="errors.first_name" class="text-danger">
                            {{ errors.first_name }}
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Priezvisko</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Meno" v-model="form.last_name">
                    <div v-if="errors.last_name" class="text-danger">
                            {{ errors.last_name }}
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Uložiť</button>
            </div>
                   
        </form>
        
    </AppLayout>
</template>




<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm } from '@inertiajs/inertia-vue3'


    const props = defineProps({
        user_id: BigInt,
        username: String,
        errors: Object
    })



    const form = useForm({
            user_id: props.user_id,
            first_name: null,
            last_name: null,
            nickname: null,
            birst_date: null,
            shirt_number: null,
            photo: null,
            about: null,
            about: null,
            show_first_name: true,
            show_last_name: true,
            show_nickname: true,
            show_birst_date: false,
            show_shirt_number: true,
            show_photo: false,
            show_about: false,
            show_user: false,

        })



    const submit = () => {
        form.patch(route('admin.group.edit', props.group.id))
    }




</script>