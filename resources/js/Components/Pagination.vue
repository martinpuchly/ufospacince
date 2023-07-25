<template>
    <div v-if="links.length > 3" class="d-block ">
        <div class="flex flex-wrap mt-5 text-center">
            <template v-for="(link, key) in links" :key="key">
                <div
                    v-if="link.url === null"
                    class="mx-1 mb-1 px-3 py-2 fs-6 text-secondary border rounded d-inline-block"
                    v-html="link.label"
                />

                <Link
                    v-else
                    class="mx-1 mb-1 px-3 py-2 text-sm leading-4 border rounded hover:border-primary focus:border-primary focus:text-danger d-inline-block"
                    :class="{ 'bg-white': link.active }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/vue3";
export default defineComponent({
    components: {
        Link,
    },
    props: {
        links: Array,
    },
});
</script>