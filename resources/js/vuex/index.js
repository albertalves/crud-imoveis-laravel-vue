import Vue from 'vue';
import Vuex from 'vuex';

import auth from './modulos/auth';
import preloader from './modulos/comum/preloader';
import propriedade from './modulos/propriedade';
import contratos from './modulos/contrato';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        auth,
        preloader,
        propriedade,
        contratos
    }
});

export default store;