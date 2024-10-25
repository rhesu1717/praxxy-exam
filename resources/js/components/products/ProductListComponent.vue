<template>
    <div>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(productList, index) in productLists.data" :key="index" align="center">
                    <td>{{ productList.name }}</td>
                    <td>{{ productList.category_id }}</td>
                    <td>{{ productList.description }}</td>
                    <td>{{ productList.date_and_time }}</td>
                </tr>
            </tbody>
        </table>
        <BPagination
            v-model="currentPage"
            :total-rows="productLists.total"
            :per-page="productLists.per_page"
            first-text="First"
            prev-text="Prev"
            next-text="Next"
            last-text="Last"
            @page-click="pageClick()"
        />
    </div>
</template>
<script setup>
import { onMounted, computed, ref, nextTick } from "vue";
import { useStore } from "vuex";

const currentPage = ref(1)
const $store = useStore();

const productLists = computed(() => {
    return $store.state.productLists
})

onMounted(() => {
    getProductList(currentPage.value)
});

const pageClick = async() => {
    await nextTick()
    getProductList(currentPage.value)
}

const getProductList = (page) => {
    $store.dispatch('getProductList', page)
}
</script>
