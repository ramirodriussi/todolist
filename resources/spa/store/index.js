export const state = () => ({

    cardDialog: {
        id: null,
        add: false,
        show: false
    },
    columnId: null,
    columns: [],

});

export const mutations = {

    showCardDialog: (state, payload) => {

        if(!payload.add) state.cardDialog.id = payload.id;

        state.cardDialog.add = payload.add;
        state.cardDialog.show = !state.cardDialog.show;

    },

    setColumnId: (state, payload) => {
        state.columnId = payload;
    },

    setCard: (state, payload) => {

        const column = state.columns.find(item => item.id == state.columnId);

        const obj = {
            id: payload.id,
            task: payload.task,
            date: payload.date,
        }

        column.cards.push(obj);

    },

    editCard: (state, payload) => {

        const card = state.columns.find(item => item.id === state.columnId).cards.find(card => card.id === payload.id);

        card.task = payload.task;
        card.date = payload.date;

    },

    sortCard: (state, payload) => {

        state.columns[payload.columnIndex].cards = payload.cards;
        
        // let card = state.cards.find(item => item.id === payload.cards[0].id).columnId = payload.columnIndex;

    },

    setColumns: (state, payload) => {

        state.columns = payload;
        console.log(state.columns);

    }
    
}

export const actions = {

    async setCard({commit}, payload){

        let resp = await this.$axios.post('/api/cards', payload);

        commit('setCard', resp.data.data);

    },

    async editCard({commit}, payload){

        let resp = await this.$axios.put(`/api/cards/${payload.id}`, {task: payload.task, date: payload.date});

        commit('editCard', payload);

    },

    async getColumns({commit}){

        let resp = await this.$axios.get('/api/dashboard');

        commit('setColumns', resp.data);

    },

    changeColumn({commit}, payload){

        this.$axios.put(`/api/cards/${payload.id}/column/${payload.columnId}`);

    }
    
}

export const getters = {

    getCards: (state) => {

        return state.columns;

        // state.columns.forEach(column => {
        //     // console.log(column);
        //     column.cards = state.cards.filter(card => card.columnId === column.id);
        // });

        // return state.columns;

    }

}