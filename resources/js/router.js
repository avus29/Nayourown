import Vue from 'vue'
import VueRouter from 'vue-router'

import About from './views/About.vue'
import Home from './views/Home.vue'
import Register from './views/Register.vue'
import Login from './views/Login.vue'
import Report from './views/Report.vue'
import CreateReport from './views/CreateReport.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Home },
        { path: '/about', component: About },
        { path: '/register', component: Register},
        { path: '/login', component: Login,name: 'login', props: true},
        { path: '/reports/:slug/:id', component: Report},
        { path: '/create-report', component: CreateReport},
    ],
});

export default router;