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
                <button type="button" @click="filter" class="btn btn-primary">
                    <i class="nav-arrow bi bi-search"></i>
                </button>
            </div>
            <div class="col-8">
                <RouterLink to="/video/create" class="btn btn-primary float-right">
                    Create <i class="nav-arrow bi bi-plus-square"></i>
                </RouterLink>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th>Name</th>
                    <th>Video</th>
                    <th><i class="nav-arrow bi bi-gear-fill"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr align="center" v-for="(video, index) in videos" :key="index">
                    <td class="align-middle">{{ video.name }}</td>
                    <td class="align-middle">
                        <video width="220" height="140" controls>
                            <source :src="video.src" type="video/mp4">
                        </video>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" @click.prevent="selectForDeleteVideoId(video.id)" data-bs-toggle="modal" data-bs-target="#deleteVideoItemModal" class="btn btn-sm btn-danger"><i class="nav-arrow bi bi-trash"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <BPagination
            v-model="currentPage"
            :total-rows="videos.total"
            :per-page="videos.per_page"
            first-text="First"
            prev-text="Prev"
            next-text="Next"
            last-text="Last"
            @page-click="pageClick()"
        />
        <ConfirmDeleteComponent
            id="deleteVideoItemModal"
            title="Confirm delete"
            body="Are you sure you want to delete this item?"
            @confirmDelete="deleteVideoItem"
        />
    </div>
</template>
<script setup>
import { onMounted, computed, ref, nextTick } from 'vue';
import { useStore } from "vuex";
import { useRoute } from "vue-router";
import ConfirmDeleteComponent from "../modal/ConfirmDeleteComponent.vue";
import { Modal } from 'bootstrap'

const search = ref('');
const currentPage = ref(1)
const videoId = ref(null)

const selectForDeleteVideoId = (id) =>{
    videoId.value = id
}

const $store = useStore();
const route = useRoute()

const videos = computed(() => {
    return $store.state.videos
})

onMounted(() => {
    getVideos()
});

const successMessage = computed(() => {
    return route.query.success
})

const getVideos = () => {
    $store.dispatch('getVideos', {search: search.value})
}

const filter = () => {
    $store.dispatch('getVideos', {search: search.value})
}

const deleteVideoItem = async(val) => {
    await nextTick()
    if(val){
        axios.delete(`/api/video/${videoId.value}`).then((res) => {
            if(res.status == 200){
                getVideos()
            }

            var myModalEl = document.getElementById('deleteVideoItemModal');
            var modal = Modal.getInstance(myModalEl)
            modal.hide();
        })
    }else{
        productId.value = null
    }
}
</script>