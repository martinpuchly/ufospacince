<template>
    <div class="container container-main pb-5 rounded-bottom"> 
        <header>
            <div class="row">
                <div class="col-sm-2 text-center">
                    <Link :href="route('/')"><img src="/images/logo.png" class="img-fluid px-3 py-2" style="max-height: 8rem;" alt="logo U.F.O. Špačince"></Link>
                </div>
                <div class="col-sm-10 my-auto text-center text-md-start pt-2">
                    <div class="header-title d-none d-sm-block">U.F.O. Špačince</div>    
                    <div class="header-subtitle d-none d-sm-block">ultimate frisbee team</div>    
                </div>
            </div>
            <Nav/>
        </header>
        <main class="row">
            <section class="px-5 pt-4">
                <Messages/>
                <slot/>
            </section>
        </main>
    </div>
    <footer class="my-3 pb-5 container text-center text-white">U.F.O. Špačince, &copy;{{ new Date().getFullYear() }}
</footer>
</template>


<script setup>
    import Nav from '@/Layouts/Nav.vue'
    import Messages from '@/Shared/Messages.vue'
    import { Link } from '@inertiajs/vue3'


</script>