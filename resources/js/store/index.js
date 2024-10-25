import { createStore } from "vuex";

export default createStore({
    state: {
        products: [],
        categories: [],
    },
    getters: {},
    mutations: {
        getProducts(state, payload){
            state.products = payload
        },
        getCategories(state, payload){
            state.categories = payload
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
        getCategories({commit}, data){
            return axios.get('/api/category')
                .then((res) => {
                    commit('getCategories', res.data)
                })
        }
    },
    modules: {
    },
});
