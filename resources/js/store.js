import axios from 'axios'
import { createApp } from 'vue'
import { createStore } from 'vuex'
import createPersistedstate from 'vuex-persistedstate'

const store = createStore({
    state: {
        user: {}
    },
    mutations: {
        setUserStates: (state, value) => state.user = value
    },
    actions: {
        userStateAction: ({ commit }) => {
            axios.get('api/user/me').then(Response => {
                const userResponse = Response.data.user
                commit('setUserStates', userResponse)
            })
        }
    }
    ,
    plugins: [createPersistedstate()]
})

const app = createApp()
app.use(store)
app.mount('#app')

export default store
