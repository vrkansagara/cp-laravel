import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import welcome from './components/Welcome'
import page from './components/Page'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'welcome',
            component: welcome,
            props: { title: "This is the SPA home" }
        },
        {
            path: '/spa-page',
            name: 'page',
            component: page,
            props: {
                title: "This is the SPA Second Page",
                author : {
                    name : "Fisayo Afolayan",
                    role : "Software Engineer",
                    code : "Always keep it clean"
                }
            }
        },
    ],
})
const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
