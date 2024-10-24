import './bootstrap';
// import '@fontsource/source-sans-3/index.css'
// import 'overlayscrollbars/overlayscrollbars.css'
// import { 
//     OverlayScrollbars, 
//   } from 'overlayscrollbars';
// import 'bootstrap-icons/font/bootstrap-icons.min.css'
import 'admin-lte/dist/css/adminlte.css'
// import '@popperjs/core/dist/umd/popper.min.js'
// import 'bootstrap/dist/js/bootstrap.min.js'
// import 'admin-lte/dist/js/adminlte.js'

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






    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">

    <link rel="stylesheet" href="../../../dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)--></link>