<template>
    <div class="row">
        <div class="col-md-4">
            <label for="title" class="form-label">Titulok článku: </label>
            <input type="text" class="form-control" id="title" placeholder="titulok" v-model="form.title">
            <div v-if="errors.title" class="text-danger">
                    {{ errors.title }}
            </div>
        </div>
        <div class="col-md-4">
            <label for="tags" class="form-label">Tagy:</label>
            <input type="text" class="form-control" id="tags" placeholder="tagy" v-model="form.tags">
            <small>delené čiarkou, napr: turnaj,prehra,sme lúzri</small>
            <div v-if="errors.tags" class="text-danger">
                    {{ errors.tags }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="published_at" class="form-label d-block">Publikovanie:</label>
                <input type="datetime-local" class="form-control d-block" aria-label="Text input with checkbox" id="published_at" v-model="form.published_at">
                <div v-if="errors.published_at" class="text-danger">
                        {{ errors.published_at }}
                </div>
            </div>
            <div class=" form-check">
                <input class="form-check-input" type="checkbox" value="" id="published" v-model="form.published">
                <label class="form-check-label" for="published">
                    publikované
                </label>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <label for="keywords" class="form-label">Kľúčové slová: </label>
            <input type="text" class="form-control" id="keywords" placeholder="kľúčové slová stránky" v-model="form.keywords">
            <div v-if="errors.keywords" class="text-danger">
                    {{ errors.keywords }}
            </div>
        </div>
        <div class="col-md-6">
            <label for="description" class="form-label">Popis článku: </label>
            <input type="text" class="form-control" id="description" placeholder="popis obsahu stránky" v-model="form.description">
            <div v-if="errors.description" class="text-danger">
                    {{ errors.description }}
            </div>
        </div>
    </div>

    <div class="row mt-5 mb-5" style="display: block;">
        <div class="col-md-12">
            <label for="intro" class="form-label">Úvod článku: </label>
            <div v-if="errors.intro" class="text-danger">
                    {{ errors.intro }}
            </div>
            <QuillEditor theme="snow" :modules="modules" toolbar="full" v-model:content="form.intro" contentType="html"></QuillEditor>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <label for="intro" class="form-label">Text článku: </label>
            <div v-if="errors.body" class="text-danger">
                    {{ errors.body }}
            </div>

            <QuillEditor theme="snow" :modules="modules" toolbar="full" v-model:content="form.body" contentType="html"></QuillEditor>
        </div>
    </div>
    <div class="mt-5">
        <button type="submit" class="btn btn-primary mt-5">Uložiť</button>
    </div>
</template>


<script setup>    

    import { QuillEditor } from '@vueup/vue-quill'
    import BlotFormatter from 'quill-blot-formatter/dist/BlotFormatter'
    import '@vueup/vue-quill/dist/vue-quill.snow.css';



    const props = defineProps({
        form: Object,
        errors: Object,
    })


    const modules = {
      name: 'blotFormatter',  
      module: BlotFormatter, 
      options: {/* options */}
    }


</script>