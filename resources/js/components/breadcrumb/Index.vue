<template>
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{routeName}}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <template v-for="(route, index) in routes.matched" :key="index">
                            <li v-if="routes.matched.length == index + 1" class="breadcrumb-item active" aria-current="page">
                                {{route.name.charAt(0).toUpperCase() + String(route.name).slice(1)}}
                            </li>
                            <li v-else class="breadcrumb-item"><RouterLink :to="route.path">{{route.name.charAt(0).toUpperCase() + String(route.name).slice(1)}}</RouterLink></li>
                        </template>
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li> -->
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
</template>
<script setup>
import { useRoute } from "vue-router";
import { computed, nextTick } from "vue";

const routes = useRoute();
// const routeName = ref(routes.matched.at(routes.matched.lenght - 1).name)

const routeName = computed( ()=>{
    return (routes.matched.at(routes.matched.lenght)?.name).toUpperCase()
})
</script>
