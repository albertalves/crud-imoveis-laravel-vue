const URL_BASE = '/api';

import router from '../../../routes';

export default {
    state: {
        me: {},
        authenticated: false,
        urlBack: 'propriedades',
    },

    mutations: {
        AUTH_USER_OK(state, user) {
            state.authenticated = true
            state.me = user
        },

        CHANGE_URL_BACK(state, url) {
            state.urlBack = url;
        },

        AUTH_USER_LOGOUT(state) {
            state.me = {}
            state.authenticated = false
        }
    },

    actions: {
        register(context, params) {
            context.commit('CHANGE_PRELOADER', true)

            return new Promise((resolve, reject) => {
                axios.post(URL_BASE + '/register', params)
                    .then(response => {
                        context.commit('AUTH_USER_OK', response.data.user)
                        
                        const token = response.data.token;
                        localStorage.setItem('TOKEN_AUTH', token)
                        window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
                        resolve()
                    })
                    .catch(error => reject(error))
                    .finally(() => context.commit('CHANGE_PRELOADER', false));
            })
        },
        
        login(context, params) {
            context.commit('CHANGE_PRELOADER', true)
            return new Promise((resolve, reject) => {
                axios.post(URL_BASE + '/auth', params)
                    .then(response => {
                        context.commit('AUTH_USER_OK', response.data.user)

                        const token = response.data.token;
                        localStorage.setItem('TOKEN_AUTH', token)
                        window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

                        resolve()
                    })
                    .catch(error => reject(error))
                    .finally(() => context.commit('CHANGE_PRELOADER', false))
                ;
            })
        },

        checkLogin(context) {
            return new Promise((resolve, reject) => {
                //pega o token no localstorange
                const token = localStorage.getItem('TOKEN_AUTH')

                //se o token não existir retorna o reject de erro
                if(!token) 
                    return reject();

                axios.get(URL_BASE + '/me')
                    .then(response => {

                        context.commit('AUTH_USER_OK', response.data.user);

                        resolve();
                    })
                    .catch(error => {
                        this.dispatch('logout');
                        reject(error);
                    });
            })
        },

        logout(context) {
            const token = localStorage.getItem('TOKEN_AUTH');
            
            context.commit('CHANGE_PRELOADER', true)

            return new Promise((resolve, reject) => {
                axios.post(URL_BASE + '/logout', token)
                        .then(() => {

                            localStorage.removeItem('TOKEN_AUTH')

                            context.commit('AUTH_USER_LOGOUT');

                            router.push({ name: 'login' });

                            resolve();
                        })
                        .catch(error => reject(error))
                        .finally(() => context.commit('CHANGE_PRELOADER', false));
            })
        }
    }
}