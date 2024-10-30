<template>
    <div class="m-3">
        <label for="videoName" class="form-label">Video Name</label>
        <input id="videoName" v-model="v$.name.$model" type="text" :class="['form-control', {'is-invalid':v$.name.$error}]" placeholder="Video Name">
        <div class="invalid-feedback" v-if="v$.name.$error">
            Name is required.
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center">
        <videojs :options="videoOptions" :url="url"/>
    </div>
    <div class="mt-3">
        <input @input="changeUrl" type="text" class="form-control" placeholder="URL">
        <button class="btn btn-primary mt-3" type="button" @click="saveVideo" :disabled="isButtonLoading">
            <span v-if="isButtonLoading" class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
            <span v-if="isButtonLoading" role="status">&nbsp;Loading...</span>
            <span v-else role="status">Save</span>
        </button>
        <!-- <button class="btn btn-primary mt-3" @click="saveVideo">Save</button> -->
        <div class="m-4">
            <label for="">Sample videos</label>
            <ul class="list-group list-group-flush">
                <template v-for="(video, index) in videoList" :key="index">
                    <li class="list-group-item">{{video}}</li>
                </template>
            </ul>
        </div>
    </div>
</template>
<script setup>
import videojs from '../videojs/Videojs.vue';
import { reactive, ref, nextTick, computed } from 'vue';
import { useRouter } from 'vue-router';
import { required } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'

const url = ref('http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4')
const videoName = ref('');

const router = useRouter()
const isButtonLoading = ref(false)

const changeUrl = async(val) => {
    nextTick()
    url.value = val.target.value
}

const form = reactive({
    name: ''
})

const rules = computed(() => {
    return {
        name: { required }
    }
})

const v$ = useVuelidate(rules, form)

const videoList = ref([
    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4',
    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4',
])

const videoOptions = reactive({
    autoplay: true,
    controls: true,
    preload: 'auto',
    responsive: true,
    playbackRates: [0.5, 1, 1.5, 2],
    controlBar: {
        skipButtons: {
            forward: 10,
            backward: 10
        },
    }
    // sources: [
    //     {
    //         src:'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
    //         type: 'video/mp4'
    //     }
    // ]
})

const saveVideo = async() => {
    const result = await v$.value.$validate()

    if(result){
        isButtonLoading.value = true
        axios.post('/api/video',{
            url: url.value,
            name: form.name
        }).then((res) => {
            if(res.status == 201){
                isButtonLoading.value = true
                router.push({ path: '/video', query:{success: 'Video added successfully'} })
            }
        })
    }
}
</script>