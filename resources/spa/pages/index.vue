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
                                v-if="register"
                                v-model="user.name"
                                label="Nombre"
                                required
                                :rules="[rules.required]"
                                outlined
                                type="text"
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
                                color="purple darken-1"
                                dense
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" class="text-center" v-if="register">
                            <v-btn color="purple darken-1 mb-2" :dark="!loading" block @click="sendForm" :loading="loading" :disabled="loading">Registrarse</v-btn>
                            <v-btn color="purple darken-1" outlined :dark="!loading" block @click="register = !register" :loading="loading" :disabled="loading">Ya soy usuario</v-btn>
                        </v-col>
                        <v-col cols="12" class="text-center" v-else>
                            <v-btn color="purple darken-1 mb-2" :dark="!loading" block @click="sendForm" :loading="loading" :disabled="loading">Ingresar</v-btn>
                            <v-btn color="purple darken-1" outlined :dark="!loading" block @click="register = !register" :loading="loading" :disabled="loading">No soy usuario</v-btn>
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

//   middleware: 'guest',

  data(){

    return {

        user: {
            name: '',
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
        register: true,

    }

  },

  methods: {

      validEmail(email) {
          var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
          return re.test(email);
      },

    async sendForm(){

        if(this.$refs.form.validate()){

            this.loading = !this.loading;

            try {     
                
                if(this.register){

                    await this.$axios.get('/sanctum/csrf-cookie');
                    let resp = await this.$axios.post('/register', this.user);

                } else {

                    let resp = await this.$auth.loginWith('laravelSanctum', {
                        data: {
                            email: this.user.email,
                            password: this.user.password
                        }
                    });

                }

                console.log(resp.data.message);
                
                // this.$store.commit('showSnackbar', {color:'success', text: resp.data.message});
                
            } catch (error) {

                console.log(error);

                // this.$store.commit('showSnackbar', {color:'error', text: error.response.data.errors.email[0]});
                
            } finally {

                this.loading = !this.loading;

            }

        }

    }

  }

}

</script>
