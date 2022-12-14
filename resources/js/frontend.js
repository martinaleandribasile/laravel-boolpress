//require('./bootstrap');
import App from "./views/App"
import router from './router'
import Vue from "vue";
window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});
