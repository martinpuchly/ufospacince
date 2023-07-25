<template>
    <div class="row">
        <div class="col-md-4">
            <label for="title" class="form-label">Titulok stránky: </label>
            <input type="text" class="form-control" id="title" placeholder="titulok" v-model="form.title">
            <div v-if="errors.title" class="text-danger">
                    {{ errors.title }}
            </div>
        </div>
        <div class="col-md-4">
            <label for="slug" class="form-label">URL adresa:</label>
            <input type="text" class="form-control" id="slug" placeholder="url adresa" v-model="form.slug">
            <div v-if="errors.slug" class="text-danger">
                    {{ errors.slug }}
            </div>
        </div>
        <div class="col-md-4">
            <label for="accessLevel" class="form-label">Prístup:</label>
            <select v-model="form.accessLevel" class="form-select"  id="accessLevel">
                <option v-for="(show_option, index) in show_options" v-key="index" :value="index">{{ show_option }}</option>
            </select>
            <div v-if="errors.accessLevel" class="text-danger">
                    {{ errors.accessLevel }}
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <label for="description" class="form-label">Popis stránky: </label>
            <input type="text" class="form-control" id="description" placeholder="popis obsahu stránky" v-model="form.description">
            <div v-if="errors.description" class="text-danger">
                    {{ errors.description }}
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
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
        show_options: Object
    })


    const modules = {
      name: 'blotFormatter',  
      module: BlotFormatter, 
      options: {/* options */}
    }


</script>