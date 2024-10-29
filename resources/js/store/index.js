import { createStore } from "vuex";

export default createStore({
    state: {
        products: [],
        categories: [],
        productDetails: {
            name: '',
            categoryId: '',
            description: '',
            images:[],
        }
    },
    getters: {},
    mutations: {
        getProducts(state, payload){
            state.products = payload
        },
        getCategories(state, payload){
            state.categories = payload
        },
        deleteProduct(state, payload){
            state.products.data = state.products.data.filter(val => val.id!=payload)
        },
        getProductDetails(state, payload){
            state.productDetails.name = payload.name
            state.productDetails.categoryId = payload.category_id
            state.productDetails.description = payload.description
            state.productDetails.images = payload.images
        }
    },
    actions: {
        getProducts({commit}, data){
            return axios.get('/api/product',{
                    params:{
                        search: data.search,
                        category: data.category_id,
                        page: data.page
                    }
                })
                .then((res) => {
                    commit('getProducts', res.data)
                })
        },
        deleteProduct({commit}, id){
            return axios.delete(`/api/product/${id}`)
                .then((res) => {
                    let isProductDelete = res.data

                    if(isProductDelete){
                        commit('deleteProduct', id)
                    }
                })
        },
        getCategories({commit}, data){
            return axios.get('/api/category')
                .then((res) => {
                    commit('getCategories', res.data)
                })
        },
        getProductDetails({commit}, id){
            return axios.get(`/api/product/${id}/edit`)
                .then((res) => {
                    return res.data?.data
                    // commit('getProductDetails', res.data?.data)
                })
        }
    },
    modules: {
    },
});
