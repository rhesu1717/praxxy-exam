import { createWebHistory, createRouter } from 'vue-router'

import ProductListComponent from '../components/products/ProductListComponent.vue'
import DashboardComponent from '../components/dashboard/Index.vue'
import PageNotFoundComponent from '../components/pagenotfound/index.vue'
import ProductCreateComponent from '../components/products/ProductCreateComponent.vue'

const routes = [
    {
        path: '/dashboard',
        component: DashboardComponent
    },
    {
        path: '/product',
        children: [
            {
                path: '',
                component: ProductListComponent
            },
            {
                path: 'create',
                component: ProductCreateComponent
            }
        ]
    },
    {
        path: '/:pathMatch(.*)*',
        component: PageNotFoundComponent
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;