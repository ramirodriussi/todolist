<template>
    
    <v-dialog
    transition="dialog-bottom-transition"
    max-width="600"
    v-model="dialog.show"
    >

    <template v-slot:default="dialog">
        <v-card>
        <v-toolbar
            color="purple lighten-4"
            dark
        >Tarjeta</v-toolbar>
        <v-card-text class="pa-4">

            <v-form ref="form">

                <v-text-field
                    label="Texto"
                    outlined
                    v-model="form.text"
                    :rules="[rules.required]"
                ></v-text-field>

                <v-menu
                v-model="menu"
                :close-on-content-click="false"
                max-width="290"
                >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                    :value="computedDate"
                    clearable
                    label="Fecha de entrega"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                    @click:clear="form.date = null"
                    :rules="[rules.date]"
                    ></v-text-field>
                </template>
                <v-date-picker
                    v-model="form.date"
                    @change="menu = false"
                ></v-date-picker>
                </v-menu>

            </v-form>

        </v-card-text>
        <v-card-actions class="justify-end">
            <v-btn
            color="success"
            @click="saveCard"
            >Guardar</v-btn>
            <v-btn
            text
            outlined
            @click="closeDialog"
            >Cerrar</v-btn>
        </v-card-actions>
        </v-card>
    </template>
    </v-dialog>

</template>

<script>

import { mapState } from 'vuex';

export default {

    data() {
      
        return {

            form: {
                text: '',
                date: ''
            },
            // text: '',
            // date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
            menu: false,
            rules: {

                required: value => !!value || 'El campo es obligatorio',
                date: (value) => {

                    let today = this.$moment().format('l');
                    
                    if(this.$moment(value).isBefore(today)){
                        return 'La fecha debe ser mayor al día de hoy';
                    }

                    return true;

                }

            },

        }

    },

    computed: {

        dialog:{

            get(){
                return this.$store.state.cardDialog;
            },

            set(){
                this.$store.commit('showCardDialog', {add: false});
            }
            
        },

        computedDate () {

            return this.form.date ? this.$moment(this.form.date).format('l') : '';

        },

        ...mapState(['columnId', 'columns']),

    },

    watch: {

        dialog: {

            handler(){

                if(this.dialog.add){

                    // this.form.date = (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10);
                    this.form.text = '';
                    this.form.date = this.$moment().format('YYYY-MM-DD');
                
                } else {

                    if(this.dialog.id){

                        const card = this.columns.find(item => item.id === this.columnId).cards.find(c => c.id === this.dialog.id);

                        this.form.text = card.text;
                        this.form.date = this.$moment(card.date).format('YYYY-MM-DD');

                    }

                }

            },

            deep: true,

        }

    },

    methods: {

        closeDialog(){
            this.$store.commit('showCardDialog', {add: false});
        },

        saveCard(){

            if(this.$refs.form.validate()){

                if(this.dialog.add){

                    this.$store.dispatch('setCard', {text:this.form.text,date:this.form.date});

                } else {

                    this.$store.commit('editCard', {text:this.form.text, date:this.form.date, id: this.dialog.id})

                }

            }

            this.$store.commit('showCardDialog', {add: false});
            
        }

    },



}

</script>