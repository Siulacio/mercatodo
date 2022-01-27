import Vue from "vue";
import Toasted from "vue-toasted";
require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

Vue.use(Toasted);

//window.Vue = require('vue').default;
window.Vue = require('vue');
Vue.component('vue-example-name', require('./components/VueExample.vue').default);
Vue.component('user', require('./components/User.vue').default);
Vue.component('product', require('./components/Product.vue').default);
Vue.component('showcase', require('./components/Showcase.vue').default);
Vue.component('reports', require('./components/Reports.vue').default);

const app = new Vue({
    el: '#app',
});
