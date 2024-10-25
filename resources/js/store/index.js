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
        getProductList({commit}, page){
            return axios.get('/api/product',{
                params:{
                    page
                }
            })
                .then((res) => {
                    commit('getProductList', res.data)
                })
        }
    },
    modules: {
    },
});
