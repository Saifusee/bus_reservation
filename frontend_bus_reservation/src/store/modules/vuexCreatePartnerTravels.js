const state = {
    statePartnerTravelName: 'ahahah',
    statePartnerTravelAddress: "",
    statePartnerTravelEmail1: "",
    statePartnerTravelEmail2: "",
    statePartnerTravelDescription: "",
    statePartnerTravelContact1: "",
    statePartnerTravelContact2: "",
    statePartnerTravelContact3: "",
    statePartnerTravelContact4: "",
    statePartnerTravelContact5: "",
    statePartnerTravelContact6: "",
    statePartnerTravelContact7: "",
    statePartnerTravelContact8: "",
    statePartnerTravelContact9: "",
    statePartnerTravelContact10: "",
}

const getters ={
    getterPartnerTravelName: state =>
    {
        return state.statePartnerTravelName;
    },
    getterPartnerTravelAddress: state =>
    {
        return state.statePartnerTravelAddress;
    },
    getterPartnerTravelEmail1: state =>
    {
        return state.statePartnerTravelEmail1;
    },
    getterPartnerTravelEmail2: state =>
    {
        return state.statePartnerTravelEmail2;
    },
    getterPartnerTravelDescription: state =>
    {
        return state.statePartnerTravelDescription;
    },
    getterPartnerTravelContact1: state =>
    {
        return state.statePartnerTravelContact1;
    },
    getterPartnerTravelContact2: state =>
    {
        return state.statePartnerTravelContact2;
    },
    getterPartnerTravelContact3: state =>
    {
        return state.statePartnerTravelContact3;
    },
    getterPartnerTravelContact4: state =>
    {
        return state.statePartnerTravelContact4;
    },
    getterPartnerTravelContact5: state =>
    {
        return state.statePartnerTravelContact5;
    },
    getterPartnerTravelContact6: state =>
    {
        return state.statePartnerTravelContact6;
    },
    getterPartnerTravelContact7: state =>
    {
        return state.statePartnerTravelContact7;
    },
    getterPartnerTravelContact8: state =>
    {
        return state.statePartnerTravelContact8;
    },
    getterPartnerTravelContact9: state =>
    {
        return state.statePartnerTravelContact9;
    },
    getterPartnerTravelContact10: state =>
    {
        return state.statePartnerTravelContact10;
    },
    
}

const mutations = {
    mutatePartnerTravelName: (state, payload) =>
    {
        state.statePartnerTravelName = payload;
    },
    mutatePartnerTravelAddress: (state, payload) =>
    {
        state.statePartnerTravelAddress = payload;
    },
    mutatePartnerTravelEmail1: (state, payload) =>
    {
        state.statePartnerTravelEmail1 = payload;
    },
    mutatePartnerTravelEmail2: (state, payload) =>
    {
        state.statePartnerTravelEmail2 = payload;
    },
    mutatePartnerTravelDescription: (state, payload) =>
    {
        state.statePartnerTravelDescription = payload;
    },
    mutatePartnerTravelContact1: (state, payload) =>
    {
        state.statePartnerTravelContact1 = payload;
    },
    mutatePartnerTravelContact2: (state, payload) =>
    {
        state.statePartnerTravelContact2 = payload;
    },
    mutatePartnerTravelContact3: (state, payload) =>
    {
        state.statePartnerTravelContact3 = payload;
    },
    mutatePartnerTravelContact4: (state, payload) =>
    {
        state.statePartnerTravelContact4 = payload;
    },
    mutatePartnerTravelContact5: (state, payload) =>
    {
        state.statePartnerTravelContact5 = payload;
    },
    mutatePartnerTravelContact6: (state, payload) =>
    {
        state.statePartnerTravelContact6 = payload;
    },
    mutatePartnerTravelContact7: (state, payload) =>
    {
        state.statePartnerTravelContact7 = payload;
    },
    mutatePartnerTravelContact8: (state, payload) =>
    {
        state.statePartnerTravelContact8 = payload;
    },
    mutatePartnerTravelContact9: (state, payload) =>
    {
        state.statePartnerTravelContact9 = payload;
    },
    mutatePartnerTravelContact10: (state, payload) =>
    {
        state.statePartnerTravelContact10 = payload;
    },
}

const actions = {
    actionPartnerTravelName: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelName', payload);
    },
    actionPartnerTravelAddress: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelAddress', payload);
    },
    actionPartnerTravelEmail1: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelEmail1', payload);
    },
    actionPartnerTravelEmail2: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelEmail2', payload);
    },
    actionPartnerTravelDescription: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelDescription', payload);
    },
    actionPartnerTravelContact1: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelContact1', payload);
    },
    actionPartnerTravelContact2: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelContact2', payload);
    },
    actionPartnerTravelContact3: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelContact3', payload);
    },
    actionPartnerTravelContact4: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelContact4', payload);
    },
    actionPartnerTravelContact5: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelContact5', payload);
    },
    actionPartnerTravelContact6: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelContact6', payload);
    },
    actionPartnerTravelContact7: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelContact7', payload);
    },
    actionPartnerTravelContact8: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelContact8', payload);
    },
    actionPartnerTravelContact9: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelContact9', payload);
    },
    actionPartnerTravelContact10: ({commit}, payload) =>
    {
        commit('mutatePartnerTravelContact10', payload);
    },
}

export default {
    state,
    getters,
    mutations,
    actions,
}