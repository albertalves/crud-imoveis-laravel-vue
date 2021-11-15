import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../vuex';

// Página Principal
import HomeComponent from '../components/HomeComponent';

// Módulo Usuário
import LoginComponent from '../components/modulos/usuario/login/LoginComponent';
import RegisterComponent from '../components/modulos/usuario/register/RegisterComponent';

// Módulo Propriedade
import ListarPropriedades from '../components/modulos/propriedade/ListarPropriedades';
import CadastrarPropriedade from '../components/modulos/propriedade/CadastrarPropriedade';

// Módulo Contrato
import CadastrarContrato from '../components/modulos/contrato/CadastrarContrato';


Vue.use(VueRouter);

const routes = [
    {
        path: '/login', 
        component: LoginComponent, 
        name: 'login',
        meta: {auth: false}
    },
    {
        path: '/register', 
        component: RegisterComponent, 
        name: 'register',
        meta: {auth: false}
    },
    {
        path: '/', 
        component: HomeComponent,
        meta: {auth: true},
        children: [
            {
                path: '/home',
                component: ListarPropriedades,
                name: 'home'
            },
            {
                path: '/cadastrar-propriedade',
                component: CadastrarPropriedade,
                name: 'propriedade.cadastrar',
            },
            {
                path: '/contrato',
                component: CadastrarContrato,
                name: 'contrato'
            }
        ]
    },
];

const router = new VueRouter ({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {

    //checa o usuario e atualiza toda vez que ele entra em uma rota
    store.dispatch('checkLogin')
    .then()
    .catch()

    if(to.matched.some(registro => registro.meta.auth) && !store.state.auth.authenticated){
        store.commit('CHANGE_URL_BACK', to.path);
        return router.push({name: 'login'});
    }

    //redireciona o usuario para o sistema caso ele esteja logado e tente acessar a rota de login
    if(to.meta.hasOwnProperty('auth') && !to.meta.auth && store.state.auth.authenticated) {
        return router.push({name: 'home'});
    }

    next();
});

export default router;