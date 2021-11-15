const URL_BASE = '/api/v1';

export default {
    actions: {
        buscarPropriedades(context, params) {
            context.commit('CHANGE_PRELOADER', true)

            return new Promise((resolve, reject) => {
                axios.get(URL_BASE + '/propriedades', {params})
                        .then(response => resolve(response.data))
                        .catch(error => reject(error))
                        .finally(() => context.commit('CHANGE_PRELOADER', false));
            })
        },
        cadastrarPropriedade(context, params){
            context.commit('CHANGE_PRELOADER', true)

            return new Promise((resolve, reject) => {
                axios.post(URL_BASE + '/propriedades', params)
                    .then(response => resolve(response.data))
                    .catch(error => reject(error))
                    .finally(() => context.commit('CHANGE_PRELOADER', false));
            })
        },
        excluirPropriedade(context, uuid){
            context.commit('CHANGE_PRELOADER', true)

            return new Promise((resolve, reject) => {
                axios.delete(URL_BASE + `/propriedade/${uuid}`)
                    .then(response => resolve(response))
                    .catch(error => reject(error))
                    .finally(() => context.commit('CHANGE_PRELOADER', false));
            })
        },
        atualizarPropriedadeStatus(context, params){
            axios.put(URL_BASE + '/propriedade-status', {id: params.id})
                    .then(response => resolve(response))
                    .catch(error => reject(error));
        }
    }

}
