<template>
<Head title="skupiny" />
    <AppLayout>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a :href="route('admin')">Admin</a></li>
            </ol>
        </nav>
        <h1>Skupiny užívateľov:</h1>
        <div class="row">
            <div class="col-md-8">
                <h2>Skupiny: </h2>
                <table class="table  table-striped">
                    <thead class="table-dark ">
                        <tr>
                            <th>#</th>
                            <th>Názov: </th>
                            <th>Popis: </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="group in groups" :key="group.id">
                            <td>{{ group.id }}</td>
                            <td>{{ group.name }}</td>
                            <td>{{ group.description }}</td>
                            <td>
                                <div class="row gx-5">
                                    <Link :href="route('admin.permissions.group', group.id)" title="povolenia skupiny" class="col-md-3 badge text-bg-info">
                                        povolenia
                                    </Link>
                                    <Link :href="route('admin.group.edit', group.id)" title="upraviť skupinu" class="col-md-3 badge text-bg-secondary">
                                        upraviť
                                    </Link>
                                    <Link :href="destroy(group.id)" method="delete" class="col-md-3 badge text-bg-danger">vymazať</Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h2>Pridať skupinu: </h2>
                <form @submit.prevent="submit">
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
                    <button type="submit" class="btn btn-primary">Pridať skupinu</button>        
                </form>

            </div>
        </div>
    </AppLayout>
</template>


<script setup>

    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head, Link,  useForm, router } from '@inertiajs/vue3'
    import BreezeLabel from '@/Components/InputLabel.vue'
    import BreezeInput from '@/Components/TextInput.vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import DangerButton from '@/Components/DangerButton.vue'

    const props = defineProps({
        groups: Object,
        errors: Object,
    })

    const form = useForm({
        name: '',
        description: '',
    });

    const submit = () => {
        form.post(route('admin.groups.add'), {
            onFinish: () => {
                form.name=''
                form.description=''
            },
        });
    };

    const destroy = id => {
        if(confirm('Skutočne chcete vymazať túto skupinu?')){
            router.delete(route('admin.group.delete', id))
        }
    }


</script>