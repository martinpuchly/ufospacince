<template>
    <AppLayout>
        <h1>Upraviť profil hráča</h1>
        <h3>{{ user_name }}</h3>
        <form @submit.prevent="submit" >
            <div class="row">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">Meno</label>
                    <input type="text" class="form-control" id="first_name" placeholder="Meno" disabled>
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Priezvisko</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Priezvisko" disabled>
                </div>
            </div>
            

            <div class="row">
                <div class="col-md-4">
                    <label for="photo" class="form-label">Fotka</label>
                    <img :src="player.photo" alt="fotka {{ player.fullName }}"/>
                    <input class="form-control" type="file" id="photo" v-model="form.photo">
                    <div v-if="errors.photo" class="text-danger">
                            {{ errors.photo }}
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="nickname" class="form-label">Prezývka</label>
                    <input type="text" class="form-control" id="lastnickname_name" placeholder="prezývka" v-model="form.nickname">
                    <div v-if="errors.nickname" class="text-danger">
                            {{ errors.nickname }}
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="shirt_number" class="form-label">Číslo dresu</label>
                    <input type="text" class="form-control" id="shirt_number" placeholder="xx" v-model="form.shirt_number">
                    <div v-if="errors.shirt_number" class="text-danger">
                            {{ errors.shirt_number }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="about" class="form-label">O mne</label>
                    <textarea class="form-control" id="about" rows="3" v-model="form.about"></textarea>
                    <div v-if="errors.about" class="text-danger">
                            {{ errors.about }}
                    </div>
                </div>
            </div>

            <h3>Nastavenie súkromia: </h3>
            <div class="mb-3 row">
                <label for="show_first_name" class="col-sm-2 col-form-label">Zobraziť meno: </label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm" id="show_first_name" v-model="form.show_first_name">
                        <option v-for="title, index in show_options" v-key="form" :value="index">{{ title }}</option>
                    </select>    
                    <div v-if="errors.show_first_name" class="text-danger">
                        {{ errors.show_first_name }}
                    </div>       
                </div>
            </div>

            <div class="mb-3 row">
                <label for="show_last_name" class="col-sm-2 col-form-label">Zobraziť priezvisko: </label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm" id="show_last_name" v-model="form.show_last_name">
                        <option v-for="title, index in show_options" v-key="form" :value="index">{{ title }}</option>
                    </select>
                    <div v-if="errors.show_last_name" class="text-danger">
                        {{ errors.show_last_name }}
                    </div>    
                </div>
            </div>

            <div class="mb-3 row">
                <label for="show_nickname" class="col-sm-2 col-form-label">Zobraziť prezývku: </label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm" id="show_nickname" v-model="form.show_nickname">
                        <option v-for="title, index in show_options" v-key="form" :value="index">{{ title }}</option>
                    </select>
                    <div v-if="errors.show_nickname" class="text-danger">
                        {{ errors.show_nickname }}
                    </div>    
                </div>
            </div>

            <div class="mb-3 row">
                <label for="show_birth_date" class="col-sm-2 col-form-label">Zobraziť dátum narodenia/vek: </label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm" id="show_birth_date" v-model="form.show_birth_date">
                        <option v-for="title, index in show_options" v-key="form" :value="index">{{ title }}</option>
                    </select>
                    <div v-if="errors.show_birth_date" class="text-danger">
                        {{ errors.show_birth_date }}
                    </div>    
                </div>
            </div>

            <div class="mb-3 row">
                <label for="show_shirt_number" class="col-sm-2 col-form-label">Zobraziť číslo dresu: </label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm" id="show_shirt_number" v-model="form.show_shirt_number">
                        <option v-for="title, index in show_options" v-key="form" :value="index">{{ title }}</option>
                    </select>
                    <div v-if="errors.show_shirt_number" class="text-danger">
                        {{ errors.show_shirt_number }}
                    </div>    
                </div>
            </div>

            <div class="mb-3 row">
                <label for="show_photo" class="col-sm-2 col-form-label">Zobraziť fotku: </label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm" id="show_photo" v-model="form.show_photo">
                        <option v-for="title, index in show_options" v-key="form" :value="index">{{ title }}</option>
                    </select>
                    <div v-if="errors.show_photo" class="text-danger">
                        {{ errors.show_photo }}
                    </div>    
                </div>
            </div>

            
            <div class="mb-3 row">
                <label for="show_about" class="col-sm-2 col-form-label">Zobraziť fotku: </label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm" id="show_about" v-model="form.show_about">
                        <option v-for="title, index in show_options" v-key="form" :value="index">{{ title }}</option>
                    </select>
                    <div v-if="errors.show_about" class="text-danger">
                        {{ errors.show_about }}
                    </div>    
                </div>
            </div>


            
            <div class="mb-3 row" v-if="player.user_id != undefined">
                <label for="show_user" class="col-sm-2 col-form-label">Zobraziť pridružený užívateľský profil: </label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm" id="show_user" v-model="form.show_user">
                        <option v-for="title, index in show_options" v-key="form" :value="index">{{ title }}</option>
                    </select>
                    <div v-if="errors.show_user" class="text-danger">
                        {{ errors.show_user }}
                    </div>    
                </div>
            </div>



            <button type="submit" class="btn btn-primary">Uložiť</button>

        </form>
        
    </AppLayout>
</template>




<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm } from '@inertiajs/inertia-vue3'


    const props = defineProps({
        player: Object,
        user_name: String,
        show_options: Object,
        errors: Object
    })



    const form = useForm({
            id: props.player.id,
            nickname: props.player.nickname,
            birth_date: props.player.birth_date,
            shirt_number: props.player.shirt_number,
            photo: null,
            about: props.player.about,

            show_first_name: props.player.show_first_name,
            show_last_name: props.player.show_last_name,
            show_nickname: props.player.show_nickname,
            show_birth_date: props.player.show_birth_date,
            show_shirt_number: props.player.show_shirt_number,
            show_photo: props.player.show_photo,
            show_about: props.player.show_about,
            show_user: props.player.show_user,
            active: props.player.active,

        })



    const submit = () => {
        form.patch(route('admin.group.edit', props.group.id))
    }




</script>