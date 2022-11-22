require('./bootstrap');
import App from "./views/App"
import router from './router'
import Vue from "vue";
window.Vue = require('vue');
window.axios = require('axios');



const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});
