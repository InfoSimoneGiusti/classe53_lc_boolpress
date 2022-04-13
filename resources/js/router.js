import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './pages/Home';
import About from './pages/About';
import Contact from './pages/Contact';
import Posts from './pages/Posts';
import SinglePost from './pages/SinglePost';
import NotFound from './pages/NotFound';

const router = new VueRouter({
    mode: "history", //www.miosito.it/blog/mio-post
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/chi-siamo',
            name: 'about',
            component: About
        },
        {
            path: '/contatti',
            name: 'contact',
            component: Contact
        },
        {
            path: '/blog',
            name: 'blog',
            component: Posts
        },
        {
            path: '/blog/:slug', // equivale a Laravel: Route::get('/blog/{slug}', 'Api\PostController@show');  :parametro di vue-router equivale a {parametro} delle rotte di Laravel
            name: 'single-post',
            component: SinglePost
        },
        {
            path: '/:pathMatch(.*)*', // /* => quel che c'è c'è /pippo/pluto
            name: 'not-found',
            component: NotFound
        }
    ]
});

export default router
