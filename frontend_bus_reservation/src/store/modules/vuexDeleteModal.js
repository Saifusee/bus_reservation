const state = {
    stateDeleteModalDisplay: false,
    stateDeleteModalTitle: '',
    stateDeleteModalData: '',
    stateDeleteModalSource: '',
}

const getters ={
    getterDeleteModalDisplay: state =>
    {
        return state.stateDeleteModalDisplay;
    },
    getterDeleteModalTitle: state =>
    {
        return state.stateDeleteModalTitle;
    },
    getterDeleteModalData: state =>
    {
        return state.stateDeleteModalData;
    },
    getterDeleteModalSource: state =>
    {
        return state.stateDeleteModalSource;
    },
}

const mutations = {
    mutateDeleteModalDisplay: (state, payload) =>
    {
        state.stateDeleteModalDisplay = payload;
    },
    mutateDeleteModalTitle: (state, payload) =>
    {
        state.stateDeleteModalTitle = payload;
    },
    mutateDeleteModalData: (state, payload) =>
    {
        state.stateDeleteModalData = payload;
    },
    mutateDeleteModalSource: (state, payload) =>
    {
        state.stateDeleteModalSource = payload;
    },
}

const actions = {
    actionDeleteModalDisplay: ({commit}, payload) =>
    {
        commit('mutateDeleteModalDisplay', payload);
    },
    actionDeleteModalTitle: ({commit}, payload) =>
    {
        commit('mutateDeleteModalTitle', payload);
    },
    actionDeleteModalData: ({commit}, payload) =>
    {
        commit('mutateDeleteModalData', payload);
    },
    actionDeleteModalSource: ({commit}, payload) =>
    {
        commit('mutateDeleteModalSource', payload);
    },
}

export default {
    state,
    getters,
    mutations,
    actions,
}