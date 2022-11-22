import Vue from "vue";

import VueRouter from "vue-router";

import PostsIndex from './pages/PostsIndex';
import NotFound from './pages/NotFound';
import About from './pages/About';
import Contacts from './pages/Contacts';
import Home from './pages/Home';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        { path: '/', name: 'home', component: Home },  // dichiaro le mie rotte -> dando un path(url) , un nome , e il componente che vogliamo visualizzare
        { path: '/posts', name: 'posts-index', component: PostsIndex, props: route => ({ page: route.query.page }) },
        { path: '/about', name: 'about', component: About },
        { path: '/contacts', name: 'contacts', component: Contacts },
        { path: '/*', name: 'NotFound', component: NotFound },  // va messa alla fine in quanto prende qualsiasi path
    ]
});

export default router;
