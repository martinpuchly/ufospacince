<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                    <li class="breadcrumb-item"><Link :href="route('admin.players')">Hráči</Link></li>
                </ol>
            </nav>
        <h1>Vytvoriť profil hráča</h1>
        <h3>Užívateľ: {{ user ? user.name : "nepriradený" }}</h3>
        <form @submit.prevent="submit" >
            <div class="row">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">Meno</label>
                    <input type="text" class="form-control" id="first_name" placeholder="meno" v-model="form.first_name">
                    <div v-if="errors.first_name" class="text-danger">
                            {{ errors.first_name }}
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Priezvisko</label>
                    <input type="text" class="form-control" id="last_name" placeholder="priezvisko" v-model="form.last_name">
                    <div v-if="errors.last_name" class="text-danger">
                            {{ errors.last_name }}
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary mt-3">Uložiť</button>
            </div>
                   
        </form>
        
    </AppLayout>
</template>




<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm, Link } from '@inertiajs/vue3'


    const props = defineProps({
        user: Object,
        errors: Object
    })

    const form = useForm({
            user_id: props.user ? props.user.id : null,
            first_name: null,
            last_name: null,
        })

    const submit = () => {
        let user_id = props.user ? props.user.id : ""
        form.post(route('admin.player.add', {user: user_id}))
    }

</script>