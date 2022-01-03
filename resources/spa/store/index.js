export const state = () => ({

    cardDialog: {
        id: null,
        add: false,
        show: false
    },
    columnId: null,
    // columns: [
    //     {
    //         name: 'Buffer', 
    //         id: 1, 
    //     },        
    //     {
    //         name: 'Working', 
    //         id: 2, 
    //     },
    //     {
    //         name: 'Done', 
    //         id: 3, 
    //     },
    // ],
    // cards: [
    //     {id: 1, text: 'hoal', date: '01/02/2022', columnId: 1},
    //     {id: 2, text: 'como', date: '05/02/2022', columnId: 1},
    //     {id: 3, text: 'vas', date: '08/02/2022', columnId: 1},
    // ]
    columns: [
        {
            name: 'Buffer', 
            id: 1, 
            cards: [
                {id: 1, text: 'hoal', date: '01/02/2022'},
                {id: 2, text: 'como', date: '05/02/2022'},
                {id: 3, text: 'vas', date: '08/02/2022'},
            ]
        },
        {
            name: 'Working', 
            id: 2, 
            cards: []
        },
        {
            name: 'Done', 
            id: 3, 
            cards: []
        },
    ],


});

export const mutations = {

    showCardDialog: (state, payload) => {

        if(!payload.add) state.cardDialog.id = payload.id;

        state.cardDialog.add = payload.add;
        state.cardDialog.show = !state.cardDialog.show;

        console.log(state.cardDialog);
    },

    setColumnId: (state, payload) => {
        state.columnId = payload;
    },

    setCard: (state, payload) => {

        const column = state.columns.find(item => item.id == state.columnId);

        const obj = {
            id: Math.floor(Math.random() * 100),
            text: payload.text,
            date: payload.date,
        }

        column.cards.push(obj);

        console.log(obj);

    },

    editCard: (state, payload) => {

        const card = state.columns.find(item => item.id === state.columnId).cards.find(card => card.id === payload.id);

        card.text = payload.text;
        card.date = payload.date;

    },

    sortCard: (state, payload) => {

        state.columns[payload.columnIndex].cards = payload.cards;
        
        // let card = state.cards.find(item => item.id === payload.cards[0].id).columnId = payload.columnIndex;

    }
    
}

export const actions = {


    
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