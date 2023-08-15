<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AppLayout>
        <Head title="Prihlásiť" />
        <div class="w-50 mx-auto">
            <div v-if="status" class="text-danger">
                {{ status }}
            </div>

        
            <h1>Prihlásenie</h1>
            <form @submit.prevent="submit">
                
                    <div class="mb-3">
                        <label for="email" class="form-label">Emailová adresa:</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" v-model="form.email">
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
                    <div class="row justify-content-start">
                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="remember" :checked="form.remember">
                            <label class="form-check-label" for="remember">
                                Zapamätať si ma
                            </label>
                        </div>
                        <div class="col">
                            <Link :href="route('register')" class="d-block d-md-inline-block mx-3">Registrácia</Link>
                            <a :href="route('auth.login', {service: 'facebook'})" class="d-block d-md-inline-block mx-3" title="prihlásiť cez Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 mt-3">
                        <button class="btn btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Prihlásiť
                        </button>
                    </div>


            </form>
        </div>
    </AppLayout>
</template>
