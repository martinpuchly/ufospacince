<template>
<div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" v-for="(item, index) in slides" data-bs-target="#carouselExampleCaptions" :data-bs-slide-to="index" :class="index==0 ? 'active' : ''" :aria-current="index==1 ? 'true' : ''" :aria-label="'Slide'+item.id"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item" v-for="(item, index) in slides" :class="index==0 ? 'active' : ''" style="height: 25em">
      <img :src="item.full_picture_path" class="d-block w-100" style="height: 100%; object-fit: cover;" alt="">
      <div class="carousel-caption d-none d-md-block">
        <a v-if="item.link" :href="item.link" style="color:white">
            <h5 style="color:white; font-size: 1.5rem;">{{ item.title }}</h5>
        </a>
        <h5 v-else style="color:white; font-size: 1.5rem;">{{ item.title }}</h5>

        <p v-if="item.description">{{ item.description }}</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


</template>


<script setup>


    const props = defineProps({
            slides: Object
        })

</script>