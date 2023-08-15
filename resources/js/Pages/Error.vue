<script setup>
import { computed } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({ status: Number })

const title = computed(() => {
  return {
    503: '503: Údržba',
    500: '500: Chyba stránky',
    404: '404: Stránka sa nenašla',
    403: '403: Prístup zamietnutý',
  }[props.status]
})

const description = computed(() => {
  return {
    503: 'Na stránke sa momentálne pracuje. Skúste prísť neskôr.',
    500: 'Hups, na stránke nastala chyba. Pokračujte na domovskej stránke.',
    404: 'Stránka ktorú hľadáte sa nenašla.  Pokračujte na <a href="/">domovskej stránke.</a>',
    403: 'Pre stránku ktorú sa pokúšate otvoriť nemáte povolenia.  Pokračujte na <a href="/">domovskej stránke.</a>',
  }[props.status]
})


const image = computed(() => {
  return {
    503: '/images/500.png',
    500: '/images/500.png',
    404: '/images/404.png',
    403: '/images/403.png',
  }[props.status]
})


</script>

<template>
  <AppLayout>
    <h1>{{ title }}</h1>
    <div v-html="description" class="fs-4 mb-5"></div>
    <div class="text-center">
      <img :src="image" class="img-fluid mx-auto w-50" >
    </div>

  </AppLayout>
</template>