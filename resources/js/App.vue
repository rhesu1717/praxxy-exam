<template>
    <router-view/>
</template>
<script setup>
    import {provide} from 'vue'
    const {csrfToken} = defineProps(['csrf-token'])

    provide('csrfToken', csrfToken)

</script>