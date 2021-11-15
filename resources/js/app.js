require('./bootstrap');

window.Vue = require('vue').default;

import router from './routes';
import store from './vuex';
import vuetify from './vuetify';
import snotify from 'vue-snotify';
import VueTheMask from 'vue-the-mask';

const options = {
    toast: {
        showProgressBar: false,
        timeout: 5000
    }
}

Vue.use(VueTheMask);
Vue.use(snotify, options);

Vue.component('preloader-component', require('./components/comum/PreloaderComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify
});

store.dispatch('checkLogin').then(() => router.push(store.state.auth.urlBack));