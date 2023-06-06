<template>
<Head title="upraviť skupinu" />
    <AppLayout>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a :href="route('admin')">Admin</a></li>
                <li class="breadcrumb-item"><a :href="route('admin.groups')">Skupiny</a></li>
            </ol>
        </nav>
            <h2>Upraviť skupinu: </h2>
                <form @submit.prevent="submit" >
                    <div class="mb-3">
                        <label for="name" class="form-label">Názov skupiny:</label>
                        <input type="text" class="form-control" id="name" placeholder="názov" v-model="form.name">
                        <div v-if="errors.name" class="text-danger">
                            {{ errors.name }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Názov skupiny:</label>
                        <input type="text" class="form-control" id="description" placeholder="description" v-model="form.description">
                        <div v-if="errors.description" class="text-danger">
                            {{ errors.description }}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Upraviť skupinu</button>  
                </form>
    </AppLayout>
</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head, Link, useForm } from '@inertiajs/vue3'
    import BreezeLabel from '@/Components/InputLabel.vue'
    import BreezeInput from '@/Components/TextInput.vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import { fromJSON } from 'postcss'


    const props = defineProps({
        group: Object,
        errors: Object,
    })

    const form = useForm({
            id: props.group.id,
            name: props.group.name,
            description: props.group.description,
        })

    const submit = () => {
        form.patch(route('admin.group.edit', props.group.id))
    }


</script>