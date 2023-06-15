window.Vue = require("vue").default;
import router from "./routes";
import App from "./components/App.vue";
import { BootstrapVue } from "bootstrap-vue";
import store from "./store/store";
import CKEditor from '@ckeditor/ckeditor5-vue2';

import "../../node_modules/bootstrap/dist/css/bootstrap.css";
import "../../node_modules/bootstrap/dist/js/bootstrap.bundle.js";
import "../../node_modules/bootstrap-vue/dist/bootstrap-vue.css";
import "../../node_modules/jquery/dist/jquery.min.js";
import "./assets/styles/global.css";
import '@ckeditor/ckeditor5-build-classic/build/translations/vi';

Vue.component("home-view", require("./components/Home.vue").default);
Vue.component("app", require("./components/App.vue").default);

Vue.use(BootstrapVue);
Vue.use(CKEditor)

new Vue({
    router,
    store,
    render: (h) => h(App),
}).$mount("#app");
