<template>
    <div class="container">
        <div class="row">

            <v-col cols="12" md="4" v-for="(column, i) in columns" :key="i">
                <Column :name="column.name" :index="i" :id="column.id" />
            </v-col>

            <CardDialog />

            <v-col cols="12">
                <pre>
                    {{cards}}
                </pre>
            </v-col>

        </div>
    </div>
</template>

<script>

import CardDialog from '@/components/CardDialog';
import Column from '@/components/Column';
import { mapState } from 'vuex';

export default {

    components: {
        CardDialog,
        Column,
    },

    data() {
    
        return {




        }

    },

    computed: {

        ...mapState(['columns']),

        cards: {

            get(){

                return this.$store.getters['getCards'];

            }

        }

},

    methods: {

        // addNewCard(columnId){

        //     this.$store.commit('setColumnId', columnId);
        //     this.$store.commit('showCardDialog');

        // },

    }

}

</script>

