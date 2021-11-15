<template>
   <v-container>
    <v-col cols="12">
        <v-card-title class="primary">
            <span class="headline white--text">Cadastrar Propriedade</span>
        </v-card-title>
        <v-card class="pa-5">
                <v-form @submit.prevent="onSubmit">
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    label="E-mail do proprietário"
                                    :rules="this.errors.email_proprietario"
                                    :error="(this.errors.email_proprietario) ? true : false"
                                    v-model="propriedade.email_proprietario"
                                    type="text"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Rua"
                                    :rules="this.errors.rua"
                                    :error="(this.errors.rua) ? true : false"
                                    v-model="propriedade.rua"
                                    type="text"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Número"
                                    :rules="this.errors.numero"
                                    :error="(this.errors.numero) ? true : false"
                                    v-model="propriedade.numero"
                                    type="text"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Complemento"
                                    :rules="this.errors.complemento"
                                    :error="(this.errors.complemento) ? true : false"
                                    v-model="propriedade.complemento"
                                    type="text"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Bairro"
                                    :rules="this.errors.bairro"
                                    :error="(this.errors.bairro) ? true : false"
                                    v-model="propriedade.bairro"
                                    type="text"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Cidade"
                                    :rules="this.errors.cidade"
                                    :error="(this.errors.cidade) ? true : false"
                                    v-model="propriedade.cidade"
                                    type="text"
                                ></v-text-field>
                                <v-text-field
                                    label="Estado"
                                    :rules="this.errors.estado"
                                    :error="(this.errors.estado) ? true : false"
                                    v-model="propriedade.estado"
                                    type="text"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <v-btn type="submit" :to="{name: 'home'}">Voltar</v-btn>
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
            propriedade: {
                email_proprietario: '',
                rua: '',
                numero: '',
                complemento: '',
                bairro: '',
                cidade: '',
                estado: '',
            },
            errors: {}
        }
    },
    methods:{
        onSubmit() {
            this.$store.dispatch('cadastrarPropriedade', this.propriedade)
                .then(response => { 
                    this.$router.push({name: 'home'})
                    this.$snotify.success('Propriedade cadastrada com sucesso!', 'Pronto!')
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.$snotify.error('Ocorreu um erro!', 'Ops...')
                });
        },
    }
}
</script>

<style>

</style>