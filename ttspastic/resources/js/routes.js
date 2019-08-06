import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Home.vue').default
    },
    {
        path: '/about',
        component: require('./views/About.vue').default
    },
    {
        path: '/login',
        component: require('./views/Login.vue').default
    },
    {
        path: '/dashboard',
        component: require('./views/Dashboard.vue').default,
        meta: { middlewareAuth: true }
    }
];

const router = new VueRouter({
    routes
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