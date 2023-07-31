<template>
    <AppLayout>
      <div class="row">
        <div class="col-md-9 px-2">
          <section v-if="slides.length">
            <Slider :slides="slides"></Slider>
          </section>
          <section class="mt-5">
            <h2>Najnovšie články:</h2>
            <PostBlock v-for="post in posts" v-key="post.id" :post="post" ></PostBlock>

          </section>
        </div>
        <div class="col-md-3 border-start">
          <section v-if="trainings.length" class="mb-3">
            <h3>Najbližšie tréningy</h3>
            <div v-for="training in trainings" class="border-bottom mb-3 pb-3">
                <div class="fw-bold fs-5">
                  {{ training.nicer_date_time }}
                </div>
                <div class="fs-5"><span class="fw-bold">Typ: </span>{{ training.value_type }} tréning</div>
                <div class="fs-5"><span class="fw-bold">Miesto: </span>{{ training.value_place }}</div>
            </div>
          </section>
          <section class="mt-5">
            <h3>Facebook</h3>
          </section>
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
        posts: Object,
        trainings: Object
    })


</script>