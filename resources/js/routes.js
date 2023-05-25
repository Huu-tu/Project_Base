import Vue from 'vue';
import  VueRouter from 'vue-router';
import Home from './components/Home.vue';
import Login from './components/Login.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Login,
            name: 'login',
        },
        {
            path: '/home/:id',
            component: Home,
            name: 'home',
            props: true,
        },
    ]
});

export default router;