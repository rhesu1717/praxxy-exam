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
    </div>
</template>
<script setup>
import { onMounted, computed } from "vue";
import { useStore } from "vuex";

const $store = useStore();

const productLists = computed(() => {
    return $store.state.productLists
})

onMounted(() => {
    console.log(`the component is now mounted.`);
    getProductList()
});

function getProductList(){
    $store.dispatch('getProductList')
}
</script>
