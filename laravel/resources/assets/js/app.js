
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import animate from 'animate.css'
import VueResource from 'vue-resource';
Vue.use(VueResource);
Vue.use(animate);

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import store from '../store/';
import routes from './route';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Teacher', require('./components/Teacher.vue'));
Vue.component('Student', require('./components/Student.vue'));
Vue.component('Dean', require('./components/Dean.vue'));

const router = new VueRouter({
    routes
});

const app = new Vue({
    store,
    routes,
    el: '#app'
});
