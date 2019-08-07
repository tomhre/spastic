import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/public/Home.vue').default
    },
    {
        path: '/about',
        component: require('./views/public/About.vue').default
    },
    {
        path: '/login',
        component: require('./views/public/Login.vue').default
    },
    {
        path: '/dashboard',
        component: require('./views/application/Dashboard.vue').default,
        meta: { middlewareAuth: true }
    },
    {
        path: '/clients',
        component: require('./views/application/clients/ClientsHome.vue').default,
        meta: { middlewareAuth: true }
    }
];


const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.middlewareAuth)) {                
        if (!auth.check()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            });

            return;
        }
    }

    next();
})

export default router;