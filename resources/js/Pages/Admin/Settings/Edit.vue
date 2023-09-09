<template>
    <AppLayout>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                <li class="breadcrumb-item"><Link :href="route('admin.settings')">Nastavenia</Link></li>
            </ol>
        </nav>
        <h2>Upraviť nastavenie:</h2>
        <div class="col-12 mb-4">
            <label for="slug" class="form-label">Popis nastavenia:</label>
            <div class="fs-4">{{ setting.title }}</div>
        </div>
        <form @submit.prevent="submit" >
            <div class="col-12">
                <label for="value" class="form-label">Hodnota:</label>
                <textarea  class="form-control" style="min-height: 3em;" id="value" placeholder="hodnota nastvenia" v-model="form.value"></textarea>
                <small v-if="setting.info">{{ setting.info }}</small>
                <div v-if="errors.value" class="text-danger">
                        {{ errors.value }}
                </div>
            </div>
            <div class="col-12 mt-3 text-center">
                <button class="btn btn-primary">Uložiť</button>
            </div>
        </form>
    </AppLayout>

    <Head title="upraviť stránku"></Head>


</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm, Head, Link } from '@inertiajs/vue3'

    
    const props = defineProps({
        setting: Object,
        errors: Object
    })


    const form = useForm({
        value: props.setting.value,
    })


    function submit() {
        form.patch(route('admin.setting.edit', {setting: props.setting.id}))
    }

</script>
