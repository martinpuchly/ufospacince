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
        <div class="col-md-6 col-lg-4 mx-auto">
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
                        <div class="form-check  col-md-6">
                            <input class="form-check-input" type="checkbox" value="" id="remember" :checked="form.remember">
                            <label class="form-check-label" for="remember">
                                Zapamätať si ma
                            </label>
                        </div>
                    </div>

                    <div class="ml-4 mt-3">
                        <button class="btn btn-primary d-inline-block mx-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Prihlásiť
                        </button>
                        <Link :href="route('register')" class="d-inline-block mx-3">Registrácia</Link>
                    </div>
            </form>
        </div>
    </AppLayout>
</template>
