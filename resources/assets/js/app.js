
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueToastr from "vue-toastr";

Vue.component('locations-table', require('./components/LocationsTable.vue'));
Vue.component('items-table', require('./components/ItemsTable.vue'));
Vue.component('categories-table', require('./components/CategoriesTable.vue'));
Vue.component('report-view', require('./components/ReportView.vue'));

Vue.use(VueToastr);
new Vue({el: '#app-container'});
