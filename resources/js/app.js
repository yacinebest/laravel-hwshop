require("./bootstrap");

window.Vue = require("vue");

import Toasted from "vue-toasted";

Vue.use(Toasted);

import CardEntity from "./components/indexpage/CardEntityComponent.vue";

import UserUpload from "./components/user/UserUploadComponent.vue";
import UserAvatar from "./components/user/UserAvatarComponent.vue";

import SelectCategory from "./components/category/SelectCategoryComponent.vue";

import BrandLogo from "./components/brand/BrandLogoComponent.vue";

import ImageUploader from "./components/image/ImageUploaderComponent.vue";
import ImageShow from "./components/image/ImageShowComponent.vue";

import TableIndex from "./components/indexpage/TableIndexComponent.vue";
// import TableIndex from "./components/TableIndexComponent.vue";
import Modal from "./components/indexpage/ModalComponent.vue";

const app = new Vue({
    el: "#app",
    components: {
        CardEntity,
        UserUpload,
        UserAvatar,
        SelectCategory,
        BrandLogo,
        ImageUploader,
        ImageShow,
        TableIndex,
        Modal
    }
});