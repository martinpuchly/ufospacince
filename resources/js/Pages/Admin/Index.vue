<script setup>
    import AppLayout from "@/Layouts/AppLayout.vue";

    defineProps({
        permissions: Array    
        })
</script>
<template>
    <AppLayout>

           {{ permissions }}

        
    </AppLayout>
</template>


