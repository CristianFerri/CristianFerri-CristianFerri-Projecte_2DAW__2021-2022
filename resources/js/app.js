
require('./bootstrap');

import Vue from 'vue';
window.Vue = require('vue').default;

import loader from 'vue-ui-preloader';
Vue.use(loader);

import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCQWahOW-R5vOfoVoW2o-Rqo5FNzwLP6NI',
        libraries: 'places',
    },
    installComponents: true
});

import VueSessionStorage from "vue-sessionstorage";
Vue.use(VueSessionStorage);
Vue.config.productionTip = false;

import { library } from '@fortawesome/fontawesome-svg-core';
import { faStar, faPlus, fas } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faStar, faPlus, fas);

import VueSimpleAlert from 'vue-simple-alert';
Vue.use(VueSimpleAlert);

import VueCookies from 'vue-cookies';
Vue.use(VueCookies);

Vue.component('up-coming', require('./components/Home/upComing.vue').default);
Vue.component('already-playing', require('./components/Home/alreadyPlaying.vue').default);
Vue.component('get-movie-info', require('./components/BookMovie/getMovieInfo.vue').default);
Vue.component('current-cinemas', require ('./components/cines/currentCinemas.vue').default);
Vue.component('cine-info', require ('./components/cines/cineInfo.vue').default);
Vue.component('success-final', require ('./components/test.vue').default);
Vue.component('t-butaques', require ('./components/Final/tranButaques.vue').default);
Vue.component('t-resumen', require ('./components/Final/tranResumen.vue').default);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('fa', FontAwesomeIcon);


const app = new Vue({
    el: '#app',
});
