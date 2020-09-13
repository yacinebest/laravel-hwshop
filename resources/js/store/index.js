import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios'

Vue.use(Vuex);

export default new Vuex.Store({
    state: { //data
        product_in_cart: []
    },
    getters: {},
    mutations: {
        addProduct(state, product) {
            const index = state.product_in_cart.findIndex(item => item.id === product.id);
            let orderQuantity = Number(0);
            if (index !== -1) {
                orderQuantity = Number(state.product_in_cart[index].quantity) + Number(1)
                Vue.set(state.product_in_cart, index, { id: product.id, product: product, quantity: Number(orderQuantity) });
            } else {
                orderQuantity = Number(1)
                state.product_in_cart.push({ id: product.id, product: product.product, quantity: orderQuantity })
            }
            this.commit('saveToLocalStorage')
        },
        loadProduct(state, product) {
            let orderQuantity = Number(product.quantity)
            state.product_in_cart.push({ id: product.id, product: product.product, quantity: Number(orderQuantity) })

        },
        deleteProduct(state, product) {
            const index = state.product_in_cart.findIndex(item => item.id === product.id);
            state.product_in_cart.splice(index, 1);
            this.commit('saveToLocalStorage')
        },
        updateProduct(state, product) {
            const index = state.product_in_cart.findIndex(item => item.id === product.id);
            Vue.set(state.product_in_cart, index, { id: product.id, product: product.product, quantity: product.quantity });
            this.commit('saveToLocalStorage')
        },
        updateStickyQte(state, qteTotal) {
            Array.from(document.getElementsByClassName('cercel-number')).forEach((el) => {
                if (Number(qteTotal) != 0) {
                    el.style.display = "inline-block";
                    el.innerHTML = Number(qteTotal);
                } else {
                    el.style.display = "none";
                    el.innerHTML = '';
                }

            });
        },
        saveToLocalStorage(state) {
            localStorage.setItem('products', JSON.stringify(state.product_in_cart));
        },
        loadFromLocalStorage(state) {
            if (localStorage.getItem('products')) {
                for (const iterator of JSON.parse(localStorage.getItem('products'))) {
                    this.commit('loadProduct', iterator)
                }
            }
        }
    },
    actions: {},
});