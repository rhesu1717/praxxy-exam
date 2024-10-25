<template>
    <div>
        <div class="row g-5 align-items-center mb-3">
            <div class="col-auto">
                <label for="search" class="col-form-label">Search:</label>
            </div>
            <div class="col-auto">
                <input type="text" v-model="search" id="search" class="form-control" placeholder="Search">
            </div>
            <div class="col-auto">
                <label for="category" class="col-form-label">Category:</label>
            </div>
            <div class="col-auto">
                <select v-model="category_id" id="category" class="form-control">
                    <option :value="'all'" selected>--All--</option>
                    <template v-for="(category, key) in categories" :key="key">
                        <option :value="category.id">{{ category.category_name }}</option>
                    </template>
                </select>
            </div>
            <div class="col-auto">
                <button type="button" @click="filter" class="btn btn-primary">
                    <i class="nav-arrow bi bi-search"></i>
                </button>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Date & Time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products.data" :key="index" align="center">
                    <td>{{ product.name }}</td>
                    <td>{{ product.category?.category_name}}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.date_and_time }}</td>
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
    </div>
</template>
<script setup>
import { onMounted, computed, ref, nextTick, reactive } from "vue";
import { useStore } from "vuex";

const currentPage = defineModel(1)
const search = defineModel('')
const category_id = defineModel('all')
const data = reactive({page: currentPage, search, category_id})
const $store = useStore();

const products = computed(() => {
    return $store.state.products
})

const categories = computed(() => {
    return $store.state.categories
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
</script>
