require('./bootstrap');

window.Vue = require('vue');
import router from './router'
import store from './store'
import VModal from 'vue-js-modal'
Vue.use(VModal);
import common from './common'
import form from './Form'
// Vue.mixin(form);
Vue.mixin(common);
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import moment from 'moment';
Vue.prototype.moment = moment;


Vue.component('admin-dash', require('./components/admin/home.vue').default)
const app = new Vue({
    el: '#app',
    form,
    router,
    store
});
