import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false

import router from './router';
import store from './store';

import vuetify from './plugins/vuetify';

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App),
}).$mount('#app')
