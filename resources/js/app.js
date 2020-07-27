require('./bootstrap');

window.Vue = require('vue');

import CardEntity from './components/CardEntityComponent.vue';
import UserUpload from './components/UserUploadComponent.vue';
import UserAvatar from './components/UserAvatarComponent.vue';
import SelectCategory from './components/SelectCategoryComponent.vue';

const app = new Vue({
    el: '#app',
    components: { CardEntity, UserUpload, UserAvatar, SelectCategory }
});