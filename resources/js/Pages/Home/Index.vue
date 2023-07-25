<template>
    <AppLayout>
      <div class="row">
        <div class="col-sm-9">
          <section v-if="slides.length">
            <Slider :slides="slides"></Slider>
          </section>
          <section class="mt-5">
            <h2>Najnovšie články:</h2>
            <PostBlock v-for="post in posts" v-key="post.id" :post="post" ></PostBlock>

          </section>
        </div>
        <div class="col-sm-3 d-none d-md-flex">
          <h3>Facebook</h3>
        </div>
      </div>


      <Head>
        <title>Domov</title>
        <meta name="description" content="Úvodná stránka webu U.F.O. Špačince.">
      </Head>
    </AppLayout>




</template>


<script setup>
import { Head } from '@inertiajs/vue3'

  import AppLayout from '@/Layouts/AppLayout.vue'
  import Slider from '@/Components/Slide.vue'
  import PostBlock from '../Posts/PostBlock.vue';


    const props = defineProps({
        slides: Object,
        posts: Object
    })


</script>