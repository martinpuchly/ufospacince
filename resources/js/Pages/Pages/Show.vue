<template>
    <AppLayout>
        <article>
            <header>
                <h1>{{ page.title }}</h1>
            </header>
            <main v-html="page.body" style="overflow-wrap: break-word;">

            </main>
        </article>
        <br clear="all">
        <footer class="float-end fst-italic">
            naposedy upravil {{ page.user.name }} dňa {{ page.humanize_update_date }}
        </footer>
    </AppLayout>
</template>



<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'

    const props = defineProps({
        page: Object
    })

</script>