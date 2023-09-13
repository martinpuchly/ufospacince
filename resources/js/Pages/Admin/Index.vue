
<template>
    <AppLayout>
        <h2>Administrácia: </h2>
        <div class="row">
           <div class="col-4 pb-2 mb-5 border-bottom" v-for="(permissions, index) in permission_groups">
                <h3>{{ index }}</h3>
                <div v-for="permission in permissions" v-key="permission.id" >
                    <Link :href="route(permission.route)" v-if="permission.link_in_admin_menu==1">{{ permission.name }}</Link>
                    <span v-if="permission.key=='contacts'"> (<span class="text-danger">{{ new_msg_num }}</span>/<span class="text-warning">{{ unsolved_msg_num }}</span>)</span>
                </div>
           </div>
        </div>
    </AppLayout>
</template>


<script setup>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import { Link } from "@inertiajs/vue3";
    defineProps({
        permission_groups: Array,
        new_msg_num: Number,
        unsolved_msg_num: Number
        })
</script>