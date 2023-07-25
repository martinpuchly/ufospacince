<template>
    <AppLayout>
        <h2>Kontakt:</h2>
        <form @submit.prevent="submit" >
            <div class="row">
                <div class="col-md-6">
                    <label for="email" class="form-label">Vaša emailová adresa: </label>
                    <input type="email" class="form-control" :class="errors.email ? 'is-invalid' : ''" id="email" placeholder="emailová adresa" v-model="form.email" required>
                    <div v-if="errors.email" class="text-danger">
                            {{ errors.email }}
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    <label for="text" class="form-label">Správa:</label>
                    <textarea v-model="form.text"  class="form-control" :class="errors.text ? 'is-invalid' : ''" rows="5" placeholder="vaša správa pre nás..." required></textarea>
                    <div v-if="errors.text" class="text-danger">
                            {{ errors.text }}
                    </div> 
                </div>
            </div> 
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="text-danger" v-if="form.errors.captcha_token">{{ form.errors.captcha_token }}</div>
                    <button type="submit" class="btn btn-primary"> Odoslať správu</button>
                </div>
            </div>
        </form>
    </AppLayout>

    <Head title="Kontakt"></Head>


</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm, Head, Link } from '@inertiajs/vue3'

    const props = defineProps({
        user_email: String,
        errors: Object
    })


    const form = useForm({
        email: props.user_email ? props.user_email : null,
        text: null,

    })


    function submit() {
        form.post(route('contact.add'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        })
    }





</script>
