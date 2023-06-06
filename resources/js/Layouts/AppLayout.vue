<template>
    <div class="container pb-5 rounded-bottom"> 
        <header>
            <div class="row">
                <div class="col-sm-2">
                    <img src="/images/logo.png" class="img-fluid px-3 py-2" style="max-height: 8rem;" alt="logo U.F.O. Špačince">
                </div>
                <div class="col-sm-10 my-auto">
                    <div class="header-title">U.F.O. Špačince</div>    
                    <div class="header-subtitle">ultimate frisbee team</div>    
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
</template>


<script setup>
    import Nav from '@/Shared/Nav.vue'
    import Messages from '@/Shared/Messages.vue'

</script>