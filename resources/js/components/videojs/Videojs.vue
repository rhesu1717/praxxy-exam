<template>
    <div>
        <video ref="videoPlayer" class="video-js vjs-default-skin vjs-control-bar" :controls="true">
            <source :src="url" type="video/mp4" />
        </video>
    </div>
</template>
<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from 'vue';
import videojs from 'video.js';

    const props = defineProps({
        options: {
            type: Object,
            default(){
                return {}
            }
        },
        url: String
    });

    watch(() => props.url, (newUrl) => {
        player.value.src({type: 'video/mp4', src: newUrl})
        console.log(player.value)
    })

    const player = ref(null);
    const videoPlayer = ref(null);
    

    onMounted(() => {
        initPlayer()
    });

    onBeforeUnmount(() => {
        disposePlayer()
    });


    const disposePlayer = () => {
        return new Promise((resolve, reject) => {
            if (player.value) {
                player.value.dispose();
                resolve()
            }else{
                reject()
            }
        })
        
    }

    const initPlayer = () =>{
        player.value = videojs(videoPlayer.value, props.options);
    }
</script>
<style>
    @import 'video.js/dist/video-js.css';
</style>