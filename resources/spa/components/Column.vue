<template>
    
    <v-card
    elevation="2"
    >
        <v-card-title class="d-flex justify-space-between">
            <h4>{{ name }}</h4>
            <small>{{ totalItems }}</small>
        </v-card-title>

        <v-card-text>

            <draggable v-model="cards" :group="{name: 'cards' }" @start="drag=true" @change="cardMoved(id, $event)">

                <v-card elevation="2" class="column-card pa-2 mb-3" v-for="(card, i) in cards" :key="i" @click="editCard(id, card.id)">
                    {{card.task}}
                </v-card>

            </draggable>

        </v-card-text>

        <v-card-actions>
        <v-btn
            outlined
            rounded
            text
            block
            @click="addNewCard(id)"
        >
            Agregar nueva tarjeta
        </v-btn>
        </v-card-actions>

    </v-card>
    
</template>

<script>

    import draggable from 'vuedraggable';

    export default {

        components: {
            draggable,
        },

        data() {
         
            return {



            }

        },

        props: {
            name: {
                type: String
            },
            index: {
                type: Number,
            },
            id: {
                type: Number,
            }
        },

        watch: {

            totalItems: {

                handler(newVal, oldVal){

                    if(this.index === 2 && newVal > oldVal) alert('Felicitaciones por lograrlo!');

                }

            }

        },

        computed: {

            totalItems() {

                return this.cards.length;

            },

            cards: {

                get(){
                    return this.$store.getters['getCards'][this.index].cards;
                },

                set(cards){
                    // console.log('set', this.index);
                    this.$store.commit('sortCard', {cards, columnIndex: this.index});
                }

            }

        },

        methods: {

            addNewCard(columnId){

                this.$store.commit('setColumnId', columnId);
                this.$store.commit('showCardDialog', {add: true});

            },

            editCard(columnId, cardId){

                this.$store.commit('setColumnId', columnId);
                this.$store.commit('showCardDialog', {add: false, id: cardId});

            },

            cardMoved(columnId, e){

                console.log(e);

                // to new column

                if(e.added){

                    console.log(columnId, e.added.element.id);
                    const id = e.added.element.id;
                    this.$store.dispatch('changeColumn', {columnId, id});

                }

            },

        }

    }

</script>

<style scoped>

    .column-card {
            transition: ease-in-out .2s;
            cursor: pointer;
    }

    .column-card:hover {
        background-color: #fafafa;
    }

</style>