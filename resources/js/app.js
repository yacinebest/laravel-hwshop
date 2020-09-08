require("./bootstrap");

window.Vue = require("vue");

import Toasted from "vue-toasted";

Vue.use(Toasted);

import CardEntity from "./components/backend/indexpage/CardEntityComponent.vue";

import UserAvatar from "./components/backend/user/UserAvatarComponent.vue";

import SelectCategory from "./components/backend/category/SelectCategoryComponent.vue";

import BrandLogo from "./components/backend/brand/BrandLogoComponent.vue";

import ImageUploader from "./components/backend/image/ImageUploaderComponent.vue";
import ImageShow from "./components/backend/image/ImageShowComponent.vue";

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