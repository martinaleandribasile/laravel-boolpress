import Vue from "vue";

import VueRouter from "vue-router";

import PostsIndex from './pages/PostsIndex';
import PostsShow from './pages/PostsShow';
import NotFound from './pages/NotFound';
import About from './pages/About';
import Contacts from './pages/Contacts';
import Home from './pages/Home';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        { path: '/', name: 'home', component: Home },  // dichiaro le mie rotte -> dando un path(url) , un nome , e il componente che vogliamo visualizzare
        { path: '/posts', name: 'posts-index', component: PostsIndex, props: route => ({ page: route.query.page }) },
        { path: '/posts/:id', name: 'posts-show', component: PostsShow },
        // path: 'posts/:slug'  potrei non cambiarlo ma e' piu significativo nominarlo correttamente
        { path: '/about', name: 'about', component: About },
        { path: '/contacts', name: 'contacts', component: Contacts },
        { path: '/*', name: 'NotFound', component: NotFound },  // va messa alla fine in quanto prende qualsiasi path
    ]
});

// se volessi usare lo slug al posto dell id -. devo modificare sia il controller in api di post sia la parte frontend(INDEXPOSTSCOMPONENT. POSTSINDEX E POSTSSHOW)

export default router;
