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
        name: 'Welcome'
    },
    {
        path: '/users',
        component: users,
        name: 'Users'
    },
    {
        path: '/ideas',
        component: users,
        name: 'Ideas'
    },
    {
        path: '/reports',
        component: users,
        name: 'Reports'
    },
    {
        path: '/news',
        component: users,
        name: 'News'
    },
    {
        path: '/statistics',
        component: users,
        name: 'Statistics'
    },
    {
        path: '/tags',
        component: tags,
        name: 'Tags'
    },
    {
        path: '/categories',
        component: categories,
        name: 'Categories'
    },
    {
        path: '/messages',
        component: categories,
        name: 'Messages'
    },
];

export default new Router({
    mode: 'history',
    routes
})