<template>
    <div class="container">
        <div class="row">

            <v-col cols="12" md="4" v-for="(column, i) in columns" :key="i">
                <Column :name="column.column" :index="i" :id="column.id" />
            </v-col>

            <CardDialog />

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

    middleware: 'auth',

    data() {
    
        return {

            //

        }

    },

    computed: {

        ...mapState(['columns']),

    },

    mounted(){

        this.getColumns();

    },

    methods: {

        getColumns(){

            this.$store.dispatch('getColumns');

        }

    }

}

</script>

