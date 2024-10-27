<template>
    <Steppy :step="step" :finalize="finalize" @update:step="updateStep" primaryColor1="#343a40">
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
        <template #2>Vivamus porttitor sodales ipsum in interdum. Proin suscipit ac nunc a
            tristique. Curabitur et pharetra diam, nec porttitor risus. Curabitur vel
            mauris est. In tempor nibh sed dapibus tincidunt. Donec id pharetra nunc,
            at rhoncus dui. Nulla in feugiat ante. Maecenas euismod justo eget
            dignissim faucibus. Nam elementum dolor sit amet felis sodales luctus.
            Aenean et lacus varius, mollis mi nec, posuere lectus. Pellentesque tempor
            sapien a magna fringilla iaculis.
        </template>
        <template #3>Etiam in turpis erat. Vestibulum auctor vel nibh eget vehicula. Integer
            finibus libero a ex vehicula pharetra. Suspendisse dapibus ipsum elit, nec
            euismod sapien laoreet ac. Proin ex arcu, commodo nec faucibus ac,
            pellentesque sed purus. Maecenas vitae ullamcorper nunc. Fusce dapibus
            lacinia dolor non tristique. Sed eu volutpat enim. Donec nisi nulla,
            eleifend quis mollis eu, posuere nec lorem. Donec id libero ex. Aliquam ut
            massa dolor.
        </template>
    </Steppy>
</template>
<script setup>
    import {Steppy} from 'vue3-steppy'
    import { ref, computed, onMounted, reactive, onBeforeMount } from 'vue';
    import { useStore } from "vuex";
    import { ClassicEditor, Bold, Essentials, Italic, Undo, Code, CodeBlock, Heading, Paragraph, List, Alignment } from 'ckeditor5';
    import { useVuelidate } from '@vuelidate/core'
    import { required } from '@vuelidate/validators'
    import { Ckeditor } from '@ckeditor/ckeditor5-vue';
    import 'ckeditor5/ckeditor5.css';

    const step = ref(1);
    const $store = useStore();
    const editor = ref(ClassicEditor);

    const form = reactive({
        step1:{
            name: '',
            categoryId: '',
            description: ''
        }
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
            }
        }
    })

    const v$ = useVuelidate(rules, form)

    onBeforeMount(() => {
        getCategories()
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
                
                break;
        
            default:
                break;
        }
        
    }

    const finalize = (event) => {
        console.log(event)
    }

    const getCategories = (data) => {
        $store.dispatch('getCategories', data)
    }
</script>
<style scoped>
    :deep(.steppy-pane) {
        text-align: left !important;
    }
</style>