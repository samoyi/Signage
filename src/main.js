import Vue from 'vue';
import Router from 'vue-router';
import App from './App.vue';
import Home from './components/Home.vue';
import Brand from './components/manage/Brand.vue';
import Signages from './components/manage/Signages.vue';
import NewSignage from './components/NewSignage.vue';

Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: '/',
            component: Home,
        },
        {
            path: '/brand',
            component: Brand,
        },
        {
            path: '/new',
            component: NewSignage,
        },
        {
            path: '/brand/:id',
            component: Signages,
        },
    ],
});

new Vue({
  el: '#app',
  render: h => h(App),
  router,
});
