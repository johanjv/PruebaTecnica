/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('list-users', require('./components/ListUsers.vue').default);
Vue.component('list-mails', require('./components/ListMails.vue').default);
Vue.component('form-email', require('./components/FormEmail.vue').default);

const app = new Vue({
    el: '#app',
});
