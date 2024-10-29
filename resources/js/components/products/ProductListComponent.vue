<template>
    <div>
        <div class="alert alert-success mt-3" role="alert" v-if="successMessage">
            {{successMessage}}
        </div>
        <div class="row align-items-center mb-3 pt-3">
            <div class="col-1 w-auto">
                <label for="search" class="col-form-label">Search:</label>
            </div>
            <div class="col-1 w-auto">
                <input type="text" v-model="search" id="search" class="form-control" placeholder="Search">
            </div>
            <div class="col-1 w-auto">
                <label for="category" class="col-form-label">Category:</label>
            </div>
            <div class="col-1 w-auto">
                <select v-model="category_id" id="category" class="form-control">
                    <option value='all' selected>--All--</option>
                    <template v-for="(category, key) in categories" :key="key">
                        <option :value="category.id">{{ category.category_name }}</option>
                    </template>
                </select>
            </div>
            <div class="col-1 w-auto">
                <button type="button" @click="filter" class="btn btn-primary">
                    <i class="nav-arrow bi bi-search"></i>
                </button>
            </div>
            <div class="col-7">
                <RouterLink to="/product/create" @click="filter" class="btn btn-primary float-right">
                    Create <i class="nav-arrow bi bi-plus-square"></i>
                </RouterLink>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Date & Time</th>
                    <th><i class="nav-arrow bi bi-gear-fill"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products.data" :key="index" align="center">
                    <td>{{ product.name }}</td>
                    <td>{{ product.category?.category_name}}</td>
                    <td v-html="product.description"></td>
                    <td>{{ product.date_and_time }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" @click.prevent="selectForDeleteProductId(product.id)" data-bs-toggle="modal" data-bs-target="#deleteProductItemModal" class="btn btn-sm btn-danger"><i class="nav-arrow bi bi-trash"></i></button>
                            <RouterLink :to="`/product/${product.id}/edit`" class="btn btn-sm btn-success"><i class="nav-arrow bi bi-pencil-square"></i></RouterLink>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <BPagination
            v-model="currentPage"
            :total-rows="products.total"
            :per-page="products.per_page"
            first-text="First"
            prev-text="Prev"
            next-text="Next"
            last-text="Last"
            @page-click="pageClick()"
        />
        <ConfirmDeleteComponent
            id="deleteProductItemModal"
            title="Confirm delete"
            body="Are you sure you want to delete this item?"
            @confirmDelete="deleteProductItem"
        />
    </div>
</template>
<script setup>
import { onMounted, computed, ref, nextTick, reactive } from "vue";
import { useStore } from "vuex";
import ConfirmDeleteComponent from "../modal/ConfirmDeleteComponent.vue";
import {Modal} from 'bootstrap'
import { useRoute } from "vue-router";

const route = useRoute()
const currentPage = ref(1)
const search = ref('')
const category_id = ref('all')
const productId = ref(null)
const data = reactive({page: currentPage, search, category_id})
const $store = useStore();

const products = computed(() => {
    return $store.state.products
})

const categories = computed(() => {
    return $store.state.categories
})

const successMessage = computed(() => {
    return route.query.success
})

onMounted(() => {
    getProducts(data)
    getCategories()
});

const pageClick = async() => {
    await nextTick()
    getProducts(data)
}

const filter = async() => {
    await nextTick()
    getProducts(data)
}

const getProducts = (data) => {
    $store.dispatch('getProducts', data)
}

const getCategories = (data) => {
    $store.dispatch('getCategories', data)
}

const selectForDeleteProductId = (id) =>{
    productId.value = id
}

const deleteProductItem = async(val) => {
    await nextTick()
    if(val){
        $store.dispatch('deleteProduct', productId.value).then(() => {
            var myModalEl = document.getElementById('deleteProductItemModal');
            var modal = Modal.getInstance(myModalEl)
            modal.hide();
        })
    }else{
        productId.value = null
    }
}
</script>
