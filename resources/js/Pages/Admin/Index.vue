<script setup>
    import AdminLayout from "@/Layouts/AdminLayout.vue";

    defineProps({
        permissions: Array    
        })
</script>
<template>
    <AdminLayout>

           {{ permissions }}

        
    </AdminLayout>
</template>


