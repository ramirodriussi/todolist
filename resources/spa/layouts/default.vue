<template>
  <v-app dark>

    <v-app-bar v-if="$auth.loggedIn" class="px-3" app clipped-left flat color="purple lighten-4" dark>

      <v-toolbar-title>To-do-list</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn
        outlined
        color="purple darken-3"
        @click="logout"
        rounded
      >

        <v-icon
          left
          dark
        >
          mdi-logout
        </v-icon>

        Cerrar Sesión
      </v-btn>

    </v-app-bar>

    <v-main>
      <v-container>
        <Nuxt />
      </v-container>
    </v-main>

  </v-app>
</template>

<script>

  export default {

    name: 'DefaultLayout',

    data() {
      
      return {

        clipped: false,
        drawer: false,
        fixed: false,

        miniVariant: false,
        right: true,
        rightDrawer: false,
        title: 'Vuetify.js'

      }

    },

    methods: {

      async logout(){

        try {

            await this.$auth.logout();

        } catch (error) {
            
            console.log(error);

        }

      }

    }
    
  }

</script>









