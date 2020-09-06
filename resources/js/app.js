require('./bootstrap');

window.Vue = require('vue');
import router from './router'
import store from './store'

const app = new Vue({
    el: '#app',
    router,
    store
});
