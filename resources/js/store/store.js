import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        title: '',
        userName: '',
        email: '',
        time: '',
        content: '',
    },
    getters: {
        getTitle(state) {
            return state.title;
        },
        getUserName(state) {
            return state.userName;
        },
        getEmail(state) {
            return state.email;
        },
        getTime(state) {
            return state.time;
        }, 
        getContent(state) {
            return state.content;
        }
    },
    mutations: {},
    actions: {},
})