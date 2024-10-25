import { createStore } from "vuex";

export default createStore({
    state: {
        productLists: []
    },
    getters: {},
    mutations: {
        getProductList(state, payload){
            state.productLists = payload
        }
    },
    actions: {
        getProductList({commit}){
            return axios.get('/api/product')
                .then((res) => {
                    commit('getProductList', res.data)
                })
        }
    },
    modules: {
    },
});
