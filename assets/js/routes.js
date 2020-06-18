import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './views/Home';
import Cart from "./views/Cart";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes:[
        {path:'/', name:'home', component:Home},
        {path:'/cart', name:'cart', component:Cart},
    ]
});

export default router;
