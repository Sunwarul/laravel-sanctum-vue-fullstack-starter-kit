import axios from 'axios';
import Cookies from 'js-cookie';

export default {
    namespaced: true,
    state: {
        user: null,
        token: null,
    },
    getters: {
        getUser: state => state.user,
        getToken: state => state.token
    },
    mutations: {
        SET_USER(state, value) {
            state.user = value;
        },
        SET_TOKEN(state, value) {
            state.token = value;
            Cookies.set('token', value);
        }
    },

    actions: {
        async login({ commit, dispatch }, credentials) {
            await axios.post('/api/login', credentials).then(({ data }) => {
                commit('SET_USER', data.user);
                commit('SET_TOKEN', data.token);
            });
            return dispatch('me');
        },

        me({ commit }) {
            axios.get('/api/me').then(({ data }) => {
                commit('SET_USER', data.user);
            });
        }
    }
}