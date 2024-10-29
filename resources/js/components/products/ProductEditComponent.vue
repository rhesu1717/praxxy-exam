<template>
    <Steppy :step="step" :finalize="finalize" @update:step="updateStep" primaryColor1="#343a40" doneText="Save">
        <template #1>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Name</label>
                        <input type="text" v-model="v$.step1.name.$model" :class="['form-control', {'is-invalid':v$.step1.name.$error}]" id="productName" placeholder="Name">
                        <div class="invalid-feedback" v-if="v$.step1.name.$error">
                            Name is required.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select id="productCategory" v-model="v$.step1.categoryId.$model" :class="['form-control', {'is-invalid':v$.step1.categoryId.$error}]">
                            <option selected disabled value="">--Please select Category--</option>
                            <template v-for="(category, index) in categories" :key="index">
                                <option :value="category.id">{{ category.category_name }}</option>
                            </template>
                        </select>
                        <div class="invalid-feedback" v-if="v$.step1.categoryId.$error">
                            Category is required.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" :class="['form-label', {'is-invalid':v$.step1.description.$error}]">Description</label>
                        <ckeditor
                            id="productDescription"
                            v-model="v$.step1.description.$model"
                            :model-value="v$.step1.description.$model"
                            :editor="editor"
                            :config="{
                                plugins: [Bold, Essentials, Italic, Undo, Code, CodeBlock, Heading, Paragraph, List, Alignment],
                                toolbar: [ 'undo', 'redo', '|', 'heading', '|','bold', 'italic', '|', 'code', 'codeBlock', 'numberedList', 'bulletedList', 'alignment'],
                                placeholder: 'Type the description here!',
                            }"
                        />
                        <div class="invalid-feedback" v-if="v$.step1.description.$error">
                            Description is required.
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #2>
            <div>
                <label for="productDescription" :class="['form-label', {'is-invalid': isImageRequired}]">Upload Images</label>
                <FilePond
                    ref="pond"
                    class-name="my-pond"
                    allow-multiple="true"
                    accepted-file-types="image/*"
                    :files="productImages"
                    :required="true"
                    label-idle="Drag & Drop your images or <u>Browse</u>"
                    :allowFileTypeValidation="true"
                    :fileValidateTypeDetectType="validateImages"
                    :dropValidation="true"
                    :beforePrepareFile="beforePrepareFile"
                    :server="{
                        // url: '/api/product/upload',
                        headers: {
                            'X-CSRF-TOKEN':csrfToken
                        },
                        process: {
                            url: '/api/product/upload',
                            onload: handleFilePondLoad
                        },
                        revert: handleFilePondRevert
                    }"
                />
                <div class="invalid-feedback" v-if="isImageRequired">
                    Please upload an image.
                </div>
            </div>
        </template>
        <template #3>
            <label for="productDateTime" :class="['form-label', {'is-invalid': v$.step3.dateTime.$error}]">Date & Time</label>
            <input id="productDateTime" type="datetime-local" v-model="v$.step3.dateTime.$model" class="form-control">
            <div class="invalid-feedback" v-if="v$.step3.dateTime.$error">
                Date & Time is required.
            </div>
        </template>
    </Steppy>
</template>
<script setup>
    // import {Steppy} from 'vue3-steppy'
    import Steppy from '../steppy/Vue3Steppy.vue'
    import { ref, computed, onMounted, reactive, onBeforeMount, useTemplateRef, inject, nextTick } from 'vue';
    import { useStore } from "vuex";
    import { ClassicEditor, Bold, Essentials, Italic, Undo, Code, CodeBlock, Heading, Paragraph, List, Alignment } from 'ckeditor5';
    import { useVuelidate } from '@vuelidate/core'
    import { required, requiredIf } from '@vuelidate/validators'
    import { Ckeditor } from '@ckeditor/ckeditor5-vue';
    import { useRouter, useRoute } from 'vue-router'

    // Import FilePond
    import vueFilePond from 'vue-filepond';

    // Import plugins
    import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';

    // Import styles
    import 'filepond/dist/filepond.min.css';
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

    // Create FilePond component
    const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);
    import 'ckeditor5/ckeditor5.css';

    const step = ref(1);
    const $store = useStore();
    const editor = ref(ClassicEditor);
    const pond = useTemplateRef('pond')
    const isImageRequired = ref(false);
    const imageUploaded = ref([]);
    const productImages = ref([]);
    const router = useRouter()
    const route = useRoute()
    const csrfToken = inject('csrfToken')

    const form = reactive({
        step1:{
            name: '',
            categoryId: '',
            description: ''
        },
        step2:{
            images: imageUploaded.value
        },
        step3:{
            dateTime: ''
        },
    })

    const categories = computed(() => {
        return $store.state.categories
    })

    const rules = computed(() => {
        return {
            step1: {
                name: { required },
                categoryId: { required },
                description: { required }
            },
            step3: {
                dateTime:{required}
            }
        }
    })

    const v$ = useVuelidate(rules, form)

    onBeforeMount(() => {
        getCategories()
        getProductDetails()
    })
    onMounted(() => {
        v$.value.step1.description.required.value = false
    });

    const updateStep = async(nextStep) => {
        
        switch (step.value) {
            case 1:
                    const result = await v$.value.step1.$validate()
                    if(result){
                        step.value = nextStep
                    }
                break;
            case 2:
                    if(handleFilePondInit()){
                        step.value = nextStep
                    }
                break;
        
            default:
                break;
        }
        
    }

    const finalize = async() => {
        
        nextTick()
        const result = await v$.value.step3.$validate()
        if(result){
            axios.put(`/api/product/${route.params.id}`,{
                name: form.step1.name,
                categoryId: form.step1.categoryId,
                description: form.step1.description,
                dateTime: form.step3.dateTime,
                tempImagesUploaded: imageUploaded.value
            }).then((res) => {
                console.log(res)
                if(res.status == 200){
                    router.push({ path: '/product', query:{success: 'Product updated successfully'} })
                }
            })  
        }
    }

    const getCategories = (data) => {
        $store.dispatch('getCategories', data)
    }

    const handleFilePondInit = () => {

        if(pond.value._pond.getFiles().length > 0){
            isImageRequired.value = false
            return true
        }
        isImageRequired.value = true
        return false
    }

    const validateImages = (source, type) =>{
        return new Promise((resolve, reject) => {
            if(type.startsWith('image/')){
                resolve(type)
            }
            reject(type)
        })
        
    }

    const beforePrepareFile = () => {
        handleFilePondInit()
    }

    const handleFilePondLoad = async(res) => {
        imageUploaded.value = [...imageUploaded.value, res]

        return res
    }

    const handleFilePondRevert = (uniqueId, load, error) => {
        const res = new Promise((resolve, reject) => {
            resolve(uniqueId)
        })
        res.then((result) => {
            imageUploaded.value = imageUploaded.value.filter(image => image !== result)
            axios.delete(`/api/product/destroy/${result}`)
            load()
        })
    }

    const getProductDetails = async() => {
        nextTick()
        $store.dispatch('getProductDetails', route.params.id).then((res) => {
            form.step1.name = res.name
            form.step1.categoryId = res.category_id
            form.step1.description = res.description
            form.step3.dateTime = res.date_and_time
            productImages.value = res.images.map(val => {
                return `/products/tmp/${val.folder}/${val.filename}`
            })
        })
    }
</script>
<style scoped>
    :deep(.steppy-pane) {
        text-align: left !important;
    }
</style>