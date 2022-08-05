<template>
<Head title="skupiny" />
    <AppLayout>
        <h1>Skupiny užívateľov:</h1>
        <div class="flex flex-wrap">
            <div class="basis-1/2">
                <h2>Skupiny: </h2>
                <table>
                    <thead>
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

                            <div class="flex flex-row">
                                <Link :href="route('admin.permissions.group', group.id)" title="povolenia skupiny">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                </Link>
                                <Link class="ml-4"  :as="button" :href="route('admin.group.edit', group.id)" title="upraviť skupinu">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </Link>
                                <button class="btn btn-small btn-danger ml-2" @click="destroy(group.id)" method="delete">vymazať</button>
                            </div>


 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="basis-1/2">
                <h2>Pridať skupinu: </h2>
                <form @submit.prevent="form.post(route('admin.groups.add'))">
                    <div class="form-group">
                        <label for="name">Názov skupiny: </label>
                        <input type="text" v-model="form.name" id="name">
                        <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
                    </div>
                    <div class="form-group">
                        <label for="description">Popis skupiny: </label>
                        <input type="text" v-model="form.description" id="description">
                        <div v-if="form.errors.description">{{ form.errors.description }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary ">uložiť</button>            
                </form>

            </div>
        </div>
    </AppLayout>
</template>


<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components:{
        AppLayout,
        Head,
        Link
    },
    props: {
        groups: Object,
        errors: Object,
    },
    setup () {
        const form = useForm({
            name: null,
            description: null,
        })
        const destroy = id => {
            if(confirm('Skutočne chcete vymazať túto skupinu?')){
                Inertia.delete(route('admin.group.delete', id))
            }
        }

        return { form, destroy }
    },

}
</script>