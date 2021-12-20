import Vue from "vue";

require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

//window.Vue = require('vue').default;
window.Vue = require('vue');
Vue.component('vue-example-name', require('./components/VueExample.vue').default);
const app = new Vue({
    el: '#app',
});
