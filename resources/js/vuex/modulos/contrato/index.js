const URL_BASE = '/api/v1';

export default {
    actions: {
        cadastrarContrato(context, params){
            context.commit('CHANGE_PRELOADER', true)

            return new Promise((resolve, reject) => {
                axios.post(URL_BASE + '/contratos', params)
                    .then(response => resolve(response.data))
                    .catch(error => reject(error))
                    .finally(() => context.commit('CHANGE_PRELOADER', false));
            })
        },
    }
}
