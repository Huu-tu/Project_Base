window.Vue = require('vue').default;
import router from './routes';
import App from './components/App.vue';
import { BootstrapVue } from 'bootstrap-vue';
import store from './store/store';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle.js'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.component('home-view', require('./components/Home.vue').default);
Vue.component('app', require('./components/App.vue').default);

Vue.use(BootstrapVue);

new Vue({    
    router,
    store,
    render: h => h(App),
  }).$mount('#app')
