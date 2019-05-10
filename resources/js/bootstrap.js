import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import form from './utilities/Form';


windwo.socket = io('https://192.168.10.10:3000');
window.Vue = Vue;
window.axios = axios;
window.Form = form;

Vue.use(VueRouter);

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};

let token = document.head.querySelector('meta[name="csrf-token"]');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
};



