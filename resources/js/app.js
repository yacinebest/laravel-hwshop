require("./bootstrap");

// window.Vue = require("vue");

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from "vuex";
import Toasted from "vue-toasted";

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Toasted);

Vue.component('pagination', require('laravel-vue-pagination'));



//Backend
import CardEntity from "./components/backend/indexpage/CardEntityComponent.vue";

import UserAvatar from "./components/backend/user/UserAvatarComponent.vue";

import SelectCategory from "./components/backend/category/SelectCategoryComponent.vue";

import BrandLogo from "./components/backend/brand/BrandLogoComponent.vue";

import ImageUploader from "./components/backend/image/ImageUploaderComponent.vue";
import ImageShow from "./components/backend/image/ImageShowComponent.vue";

//Frontend
import MiniCart from "./components/frontend/carts/MiniCartComponent.vue";
import CartTable from "./components/frontend/carts/CartTableComponent.vue";
import ProductCard from "./components/frontend/products/ProductCardComponent.vue";
Vue.component('product-card', ProductCard);
import CategoryPaginateFilter from "./components/frontend/categories/CategoryPaginateFilterComponent.vue";

import { routes } from './routes.js'
import store from "./store";


const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history'
})

const app = new Vue({
    el: "#app",
    router,
    store: store,
    components: {
        //Backend
        CardEntity,
        UserAvatar,
        SelectCategory,
        BrandLogo,
        ImageUploader,
        ImageShow,
        //Frontend
        MiniCart,
        CartTable,
        ProductCard,
        CategoryPaginateFilter

    }

});