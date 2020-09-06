import Vue from 'vue'
import Router from "vue-router";
Vue.use(Router)

const routes = [
    {
        path: '/home',
        component: home,
        name: 'tags'
    },
    {
        path: '/tags',
        component: tags,
        name: 'tags'
    },
    {
        path: '/categories',
        component: categories,
        name: 'categories'
    },

];

export default new Router({
    mode: 'history',
    routes
})