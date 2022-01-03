<template>

  <v-container fill-height>
    <v-row justify="center" align="center">
      <v-col cols="12" md="4">

        <v-card class="rounded-lg">
            <v-card-title>
                <h4>
                    <v-icon>mdi-login</v-icon>
                    Bienvenido
                </h4>
            </v-card-title>
            <v-card-text>
                <v-form @submit.prevent v-model="valid" ref="form">
                    <v-row>
                        <v-col class="pb-0" cols="12">
                            <v-text-field
                                v-model="user.name"
                                label="Nombre"
                                required
                                :rules="[rules.required]"
                                outlined
                                type="text"
                                @keyup.enter="sendForm(user)"
                                color="purple darken-1"
                                dense
                            ></v-text-field>
                        </v-col>
                        <v-col class="pb-0" cols="12">
                            <v-text-field
                                v-model="user.email"
                                label="Correo Electrónico"
                                required
                                :rules="[rules.required, rules.email]"
                                outlined
                                type="email"
                                @keyup.enter="sendForm(user)"
                                color="purple darken-1"
                                dense
                            ></v-text-field>
                        </v-col>
                        <v-col class="pb-0" cols="12">
                            <v-text-field
                                v-model="user.password"
                                label="Contraseña"
                                required
                                :rules="[rules.required, rules.password]"
                                outlined
                                type="password"
                                @keyup.enter="sendForm(user)"
                                color="purple darken-1"
                                dense
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" class="text-center">
                            <v-btn color="purple darken-1 mb-2" :dark="!loading" block @click="sendForm(user)" :loading="loading" :disabled="loading">Ingresar</v-btn>
                            <v-btn color="purple darken-1" outlined :dark="!loading" block @click="sendForm(user)" :loading="loading" :disabled="loading">Registrarse</v-btn>
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>

      </v-col>
    </v-row>
  </v-container>

</template>

<script>

export default {

  name: 'IndexPage',
  data(){

    return {

        user: {
            email: '',
            password: '',
        },
        loading: false,
        valid: false,
        rules: {

            required : value => !!value || 'Debés completar este campo',
            email : value => {

                return this.validEmail(value) || 'Debés ingresar un email válido'

            },
            password : value => (value && value.length >= 8) || 'La contraseña debe tener mínimo 8 caracteres'

        },
        success: '',
        error: '',

    }

  },

  methods: {

      validEmail(email) {
          var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
          return re.test(email);
      },

            async sendForm(userInfo){

                // if(this.$refs.form.validate()){

                    // this.loading = !this.loading;

                    this.$router.push('dashboard');

                    // try {            
                        
                    //     let resp = await this.$auth.loginWith('laravelSanctum', {
                    //         data: {
                    //             email: userInfo.email,
                    //             password: userInfo.password
                    //         }
                    //     });

                    //     this.$store.commit('showSnackbar', {color:'success', text: resp.data.message});
                       
                    //     this.$store.dispatch('setUser');
                    //     this.$router.push('panel');

                    // } catch (error) {

                    //     this.$store.commit('showSnackbar', {color:'error', text: error.response.data.errors.email[0]});
                        
                    // } finally {

                    //     this.loading = !this.loading;

                    // }

                // }

            }

  }

}

</script>
