import { createWebHistory, createRouter } from 'vue-router'

import ProductListComponent from '../components/products/ProductListComponent.vue'
import DashboardComponent from '../components/dashboard/Index.vue'
import PageNotFoundComponent from '../components/pagenotfound/index.vue'
import ProductCreateComponent from '../components/products/ProductCreateComponent.vue'
import ProductEditComponent from '../components/products/ProductEditComponent.vue'
import Breadcrumb from '../components/breadcrumb/Index.vue'

const routes = [
    {
        path: '/dashboard',
        components: {
            default: DashboardComponent,
            Breadcrumb
        },
        name: 'dashboard'
    },
    {
        path: '/product',
        name: 'product',
        children: [
            {
                path: '',
                name: 'list',
                components: {
                    default: ProductListComponent,
                    Breadcrumb
                },
            },
            {
                path: 'create',
                name: 'create',
                components: {
                    default: ProductCreateComponent,
                    Breadcrumb
                },
            },
            {
                path: ':id/edit',
                name: 'edit',
                components: {
                    default: ProductEditComponent,
                    Breadcrumb
                },
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