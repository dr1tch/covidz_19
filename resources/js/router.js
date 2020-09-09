import Vue from 'vue'
import Router from "vue-router";
Vue.use(Router)

import welcome from './components/admin/pages/welcome'
import users from './components/admin/pages/users'
import tags from './components/admin/pages/tags'
import categories from './components/admin/pages/categories'
import sidebar from './components/admin/templates/sidebar'
import tab from './components/admin/templates/tab'
import navbar from './components/admin/templates/navbar'
import home from './components/admin/home'


const routes = [
    {
        path: '/',
        component: welcome,
        name: 'welcome'
    },
    {
        path: '/users',
        component: users,
        name: 'users'
    },
    {
        path: '/ideas',
        component: users,
        name: 'ideas'
    },
    {
        path: '/reports',
        component: users,
        name: 'reports'
    },
    {
        path: '/news',
        component: users,
        name: 'news'
    },
    {
        path: '/statistics',
        component: users,
        name: 'statistics'
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
    {
        path: '/messages',
        component: categories,
        name: 'messages'
    },
];

export default new Router({
    mode: 'history',
    routes
})