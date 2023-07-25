<template>
    <AppLayout>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><Link :href="route('admin')">Admin</Link></li>
                    <li class="breadcrumb-item"><Link :href="route('admin.contacts')">Kontakty</Link></li>
                </ol>
            </nav>
            <h1>Správa:</h1>
            <div class="row g-2">
                <div class="col">Email: </div>
                <div class="col-9">{{ contact.email }}</div>
            </div>
            <div class="row g-2 mt-3">
                <div class="col">Správa: </div>
                <div class="col-9">{{ contact.text }}</div>
            </div>

            <div class="row g-2 mt-5" v-if="$page.props.auth.permissions.includes('contact-saveStatus')">
                <div class="col">Status správy: </div>
                <div class="col-9">
                    <select class="form-select" v-model="form.status" @change.prevent="saveStatus()">
                        <option v-for="(status, index) in statuses" :value="index">{{ status }}</option>
                    </select>
                </div>
            </div>
            
            <div class="row g-2 mt-5" v-if="$page.props.auth.permissions.includes('contact-destroy')">
                <div class="col">Vymazať správu: </div>
                <div class="col-9">
                   <Link @click.prevent="del(contact.id)" class="btn btn-danger">Vymazať správu</Link>
                </div>
            </div>
    </AppLayout>
</template>




<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link, router, useForm } from '@inertiajs/vue3'


    const props = defineProps({
        contact: Object,
        statuses: Array,
    })


    const form = useForm({
        status: props.contact.status,
    })

    function saveStatus() {
        form.patch(route('admin.contact.saveStatus', {contact: props.contact.id}))
    }

    function del(id) {
        if(confirm(`Skutočne chcete vymazať túto správu?`)){
            router.delete(route('admin.contact.delete', {contact: props.contact.id}))

        }
    }

</script>
