require('./bootstrap');

window.Vue = require('vue');

import Toasted from 'vue-toasted';

Vue.use(Toasted)

import CardEntity from './components/CardEntityComponent.vue';
import UserUpload from './components/UserUploadComponent.vue';
import UserAvatar from './components/UserAvatarComponent.vue';
import SelectCategory from './components/SelectCategoryComponent.vue';
import BrandLogo from './components/BrandLogoComponent.vue';
import ImageUploader from './components/ImageUploaderComponent.vue';
import ImageShow from './components/ImageShowComponent.vue';
import TableIndex from './components/TableIndexComponent.vue';

const app = new Vue({
    el: '#app',
    components: { CardEntity, UserUpload, UserAvatar, SelectCategory, BrandLogo, ImageUploader, ImageShow, TableIndex }
});