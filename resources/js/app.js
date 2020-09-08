require("./bootstrap");

window.Vue = require("vue");

import Toasted from "vue-toasted";

Vue.use(Toasted);

import CardEntity from "./components/indexpage/CardEntityComponent.vue";

import UserAvatar from "./components/user/UserAvatarComponent.vue";

import SelectCategory from "./components/category/SelectCategoryComponent.vue";

import BrandLogo from "./components/brand/BrandLogoComponent.vue";

import ImageUploader from "./components/image/ImageUploaderComponent.vue";
import ImageShow from "./components/image/ImageShowComponent.vue";

const app = new Vue({
    el: "#app",
    components: {
        CardEntity,
        UserAvatar,
        SelectCategory,
        BrandLogo,
        ImageUploader,
        ImageShow
    }
});