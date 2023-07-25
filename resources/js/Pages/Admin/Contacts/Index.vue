<template>
    <AppLayout>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                </ol>
            </nav>
            <div class="float-end">
                <Link :href="route('admin.contacts')">všetky</Link>
                <span> | </span>
                <Link :href="route('admin.contacts', {q: 1})">neprečítané</Link>
            </div>
            <h1>Správy od užívateľov:</h1>
            <div v-if="contacts.length>0">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Prijaté: </th>
                            <th>Status: </th>
                            <th>Možnosti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contact in contacts">
                            <td>{{ contact.id }}</td>
                            <td>{{ contact.email }}</td>
                            <td>{{ contact.human_create_date }}</td>
                            <td :style="setStatusColor(contact.status)">{{ statuses[contact.status] }}</td>
                            <td> 
                                <Link :href="route('admin.contact.show', {contact: contact.id})" class="btn btn-sm btn-info"> zobraziť
                                </Link>


                            </td>
                        </tr>
                    </tbody>
                </table>

                </div>
                <span class="text-red-500 font-semibold" v-else>
                    Zatiaľ prijaté žiadne správy od užívateľov.
                </span>
            </div>  
    </AppLayout>
</template>




<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link, router } from '@inertiajs/vue3'


    const props = defineProps({
        contacts: Object,
        statuses: Array
    })


    function setStatusColor(status) {
        switch (status) {
            case 1:
               return "color: red"
            case 2:
               return "color: orange"
            case 3:
               return "color: green"
            case 4:
               return "color: black"
             default:
                return "color: black"
        }
    }
</script>
