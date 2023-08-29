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
          <section v-if="trainings.length" class="mb-5">
            <h3>Najbližšie tréningy</h3>
            <div v-for="training in trainings" class="border-bottom mb-3 pb-3">
                <div class="fw-bold fs-5 color-p text-decoration-underline">
                  {{ training.nicer_date_time }}
                </div>
                <div class="fs-5"><span class="fw-bold color-p">Typ: </span>{{ training.value_type }} tréning</div>
                <div class="fs-5"><span class="fw-bold color-p">Miesto: </span>{{ training.value_place }}</div>
            </div>
          </section>
          <section>
            <h3>Facebook</h3>
              <div class="text-center">
                <div class="fb-page" data-href="https://www.facebook.com/ufospacince" data-tabs="timeline" data-width="290" data-height="" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ufospacince" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ufospacince">U.F.O. Špačince - Ultimate Frisbee Team</a></blockquote></div>          
              </div>
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
  import { onMounted } from 'vue'


    const props = defineProps({
        slides: Object,
        posts: Object,
        trainings: Object
    })


    onMounted(() => {
      if (typeof FB === "undefined") {
          fbInit();
      } else {
          window.FB.XFBML.parse();
      }
    })


    function fbInit() {
        window.fbAsyncInit = function() {
            FB.init({
                appId: "3768835300015863",
                autoLogAppEvents: true,
                xfbml: true,
                version: "v6.0"
            });
            FB.AppEvents.logPageView();
        };
        (function(d, s, id) {
            var js,
                fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/sk_SK/sdk.js#xfbml=1&version=v17.0&appId=3768835300015863&autoLogAppEvents=1";
            fjs.parentNode.insertBefore(js, fjs);
        })(document, "script", "facebook-jssdk");
    }


</script>