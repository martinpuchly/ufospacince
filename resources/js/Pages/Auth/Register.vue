<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AppLayout>
        <Head title="Registrácia" />
        <div class="col-md-6 col-lg-4  mx-auto">
       
            <h1>Registrácia</h1>
            <form @submit.prevent="submit">


                <div class="mb-3">
                    <label for="name" class="form-label">Používateľské meno:</label>
                    <input type="text" class="form-control" id="name" placeholder="meno" v-model="form.name">
                    <div v-if="form.errors.name" class="text-danger fw-bold">
                        {{ form.errors.name }}
                    </div>
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">Emailová adresa:</label>
                    <input type="email" class="form-control" id="email" placeholder="email" v-model="form.email">
                    <div v-if="form.errors.email" class="text-danger fw-bold">
                        {{ form.errors.email }}
                    </div>
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">Heslo:</label>
                    <input type="password" class="form-control" id="password" placeholder="***" v-model="form.password">
                    <div v-if="form.errors.password" class="text-danger fw-bold">
                        {{ form.errors.password }}
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Heslo znovu:</label>
                    <input type="password" class="form-control" id="password_confirmation" placeholder="***" v-model="form.password_confirmation">
                    <div v-if="form.errors.password_confirmation" class="text-danger fw-bold">
                        {{ form.errors.password_confirmation }}
                    </div>
                </div>
                <div class="ml-4 ">
                        <button class="btn btn-primary d-inline-block mx-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Registrácia
                        </button>
                        <Link :href="route('login')" class="d-inline-block mx-3">Prihlásiť</Link>
                    </div>
            </form>
        </div>
    </AppLayout>
</template>
