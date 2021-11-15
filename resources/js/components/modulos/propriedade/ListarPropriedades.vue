<template>
    <v-container>
        <v-col cols="12">
            <v-card-title class="primary">
                <span class="headline white--text">Propriedades</span>
            </v-card-title>
            <v-card class="pa-5">
                <v-row>
                    <v-col md="6">
                        <v-btn 
                            color="primary" 
                            @click.prevent="cadastrarPropriedade">
                            Cadastrar
                        </v-btn>
                     </v-col>
                    <v-col md="6">
                        <v-row>
                            <v-col md="8">
                                <v-text-field
                                    v-model="search"
                                    label="Buscar propriedade..."
                                    solo
                                    dense>
                                </v-text-field>
                            </v-col>

                            <v-col md="4" class="d-flex justify-space-between">
                                <v-btn
                                    @click.prevent="limpar">
                                        Limpar
                                </v-btn>
                                <v-btn
                                    color="primary"
                                    @click.prevent="buscarPropriedades"
                                    class="mr-7">
                                        Buscar
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12">
                        <v-simple-table>
                            <thead>
                                <tr>
                                    <th class="text-left">E-mail do proprietário</th>
                                    <th class="text-left">Endereço</th>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(propriedade, index) in propriedades.data" :key="index">
                                    <td>{{ propriedade.email_proprietario }}</td>
                                    <td>{{ propriedade | enderecoCompleto }}</td>
                                    <td>{{ propriedade.status | status }}</td>
                                    <td>
                                        <div class="my-2">
                                            <v-tooltip bottom>
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-btn
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        dark
                                                        color="error"
                                                        fab
                                                        x-small
                                                        elevation="1"
                                                        @click.prevent="confirmarExclusao(propriedade.uuid)"
                                                    >
                                                        <v-icon>mdi-close</v-icon>
                                                    </v-btn>
                                                </template>
                                                <span>Excluir</span>
                                            </v-tooltip>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </v-simple-table>
                    </v-col>
                </v-row>
                <v-pagination
                    v-if="params.last_page > 1"
                    v-model="params.page"
                    :length="params.last_page"
                    :total-visible="4"
                    @input="onPageChange"
                >
                </v-pagination>
            </v-card>
        </v-col>
    </v-container>
</template>

<script>
export default {
    data(){
        return {
            search: '',
            propriedades: {
                meta: {
                    current_page: '',
                    last_page: ''
                }
            },
        }
    },
    created() {
        this.buscarPropriedades();
    },
    methods:{
        buscarPropriedades(page = 1){
            this.$store.dispatch('buscarPropriedades', {search: this.search, page})
                        .then(response => this.propriedades = response);
        },
        cadastrarPropriedade(){
            this.$router.push({name: 'propriedade.cadastrar'})
        },
        confirmarExclusao(uuid) {
            this.$snotify.warning('Tem certeza que deseja excluir?', 'Confirmar', {
                timeout: 10000,
                showProgressBar: true,
                closeOnClick: true,
                buttons: [
                    {text: 'Não', action: null},
                    {text: 'Sim', action: (toast) => {this.deletarPropriedade(uuid); this.$snotify.remove(toast.uuid);} }
                ]
            })
        },
        deletarPropriedade(uuid) {
            this.$store.dispatch('excluirPropriedade', uuid)
                .then(() => {
                    this.$snotify.success('Propriedade excluída com sucesso.', 'Pronto!')
                    this.buscarPropriedades();
                })
                .catch(() => this.$snotify.error('Erro ao deletar propriedade', 'Ops...'));
        },
        limpar() {
            this.search = '';
            this.buscarPropriedades();
        },
        onPageChange() {
            this.buscarPropriedades(this.params.page);
        },
    },
    computed: {
        params() {
            return {
                page: this.propriedades.meta.current_page,
                last_page: this.propriedades.meta.last_page
            }
        }
    },
    filters: {
        enderecoCompleto: function(endereco) {
            return `${endereco.rua}, ${endereco.numero}, ${endereco.cidade}, ${endereco.estado}`;
        },
        status: function(status){
            return status == 1 ? 'Contratada' : 'Não Contratada';
        }
    }
}
</script>