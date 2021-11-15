<template>
   <v-container>
    <v-col cols="12">
        <v-card-title class="primary">
            <span class="headline white--text">Cadastrar Contrato</span>
        </v-card-title>
        <v-card class="pa-5">
                <v-form @submit.prevent="onSubmit">
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    label="Nome completo do contratante"
                                    :rules="this.errors.nome_completo_contratante"
                                    :error="(this.errors.nome_completo_contratante) ? true : false"
                                    v-model="contrato.nome_completo_contratante"
                                >
                                </v-text-field>
                                
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="E-mail do contratante"
                                    :rules="this.errors.email_contratante"
                                    :error="(this.errors.email_contratante) ? true : false"
                                    v-model="contrato.email_contratante"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-select
                                    label="Propriedade"
                                    v-model="contrato.propriedade_id"
                                    :items="propriedade_select"
                                    :rules="this.errors.propriedade_id"
                                    :error="(this.errors.propriedade_id) ? true : false"
                                    item-value='id'
                                    :item-text="labelPropriedade"
                                >
                                </v-select>
                            </v-col>
                            <v-col cols="12">
                                <v-select
                                    label="Tipo pessoa"
                                    v-model="contrato.tipo_pessoa"
                                    :items="tipo_pessoa_select"
                                    :rules="this.errors.tipo_pessoa"
                                    :error="(this.errors.tipo_pessoa) ? true : false"
                                ></v-select>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Nº Documento (CPF ou CNPJ)"
                                    v-model="contrato.documento"
                                    :rules="this.errors.documento"
                                    :error="(this.errors.documento) ? true : false"
                                    v-mask="['###.###.###-##', '##.###.###/####-##']"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <v-btn type="submit" :to="{name: 'contrato'}">Voltar</v-btn>
                                <v-btn color="primary" type="submit">Salvar</v-btn>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
        </v-card>
    </v-col>
  </v-container>
</template>

<script>

export default {
    data(){
        return {
            contrato: {
                propriedade_id: '',
                tipo_pessoa: '',
                documento: '',
                email_contratante: '',
                nome_completo_contratante: '',
            },
            errors: {},
            tipo_pessoa_select: [
                'F',
                'J'
            ],
            propriedade_select: [
            ],
        }
    },

    created() {
        this.buscarPropriedades();
    },

    methods:{
        onSubmit() {
            this.atualizarPropriedadeStatus();
            this.$store.dispatch('cadastrarContrato', this.contrato)
                .then(() => { 
                    this.$snotify.success('Contrato cadastrado com sucesso!', 'Pronto!');
                    this.atualizarPropriedadeStatus();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.$snotify.error('Erro ao cadastrar um contrato!', 'Ops...');
                });
        },
        buscarPropriedades(){
            this.$store.dispatch('buscarPropriedades', {buscarTodas: 1})
                        .then(response => this.propriedade_select = response.data);
        },
        atualizarPropriedadeStatus(){
            this.$store.dispatch('atualizarPropriedadeStatus', {id: this.contrato.propriedade_id});
        },
        labelPropriedade(item) {
            let status = 'Não contratada';
            if(item.contrato){
                status = 'Contratada';
            }

            return `Rua: ${item.rua}, nº: ${item.numero}, Complemento: ${item.complemento}, Bairro: ${item.bairro} — ${status}`;
        },
    },
}
</script>

<style>

</style>