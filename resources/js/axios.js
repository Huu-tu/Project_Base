import axios from 'axios';
import VueAxios from 'vue-axios';
import Vue from 'vue';

Vue.use(VueAxios, axios)

Vue.axios.defaults.baseURL = ""

Vue.axios.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = 'Bearer ${token}';
  }
  return config;
}, error => {
  return Promise.reject(error); 
});

export default Vue.axios;

