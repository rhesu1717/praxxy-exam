import './bootstrap';
import {createBootstrap} from 'bootstrap-vue-next'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'
import {createApp} from 'vue'
import store from './store'
import router from './router'
import App from './App.vue';
createApp({})
    .use(store)
    .use(router)
    .use(createBootstrap())
    .component('AppComponent', App)
    .mount("#app")
    
import '@fontsource/source-sans-3/index.css'
import 'overlayscrollbars/overlayscrollbars.css'
import { 
    OverlayScrollbars, 
  } from 'overlayscrollbars';
import 'bootstrap-icons/font/bootstrap-icons.min.css'
import 'admin-lte/dist/css/adminlte.css'
import '@popperjs/core/dist/umd/popper.min.js'
import 'admin-lte/dist/js/adminlte.js'

const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
const Default = {
    scrollbarTheme: "os-theme-light",
    scrollbarAutoHide: "leave",
    scrollbarClickScroll: true,
};
document.addEventListener("DOMContentLoaded", function() {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
    if (
        sidebarWrapper &&
        typeof OverlayScrollbars !== "undefined"
    ) {
        OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
                theme: Default.scrollbarTheme,
                autoHide: Default.scrollbarAutoHide,
                clickScroll: Default.scrollbarClickScroll,
            },
        });
    }
});