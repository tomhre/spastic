import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/public/Home.vue').default,
        meta: {
            middlewareAuth: true,    
            title: 'Teemo - Home',
            metaTags: [
              {
                name: 'description',
                content: 'Welcome to Teemo, your project, time and holiday management little helper.'
              },
              {
                property: 'og:description',
                content: 'Welcome to Teemo, your project, time and holiday management little helper.'
              }
            ]
        },
    },
    {
        path: '/about',
        component: require('./views/public/About.vue').default,
        meta: {
            middlewareAuth: true,    
            title: 'Teemo - About Teemo',
            metaTags: [
              {
                name: 'description',
                content: 'Have a look at how Teemo can make your time tracking, project management and holiday management made simple.'
              },
              {
                property: 'og:description',
                content: 'Have a look at how Teemo can make your time tracking, project management and holiday management made simple.'
              }
            ]
        },
    },
    {
        path: '/login',
        component: require('./views/public/Login.vue').default,
        meta: {
            middlewareAuth: true,    
            title: 'Teemo - Login',
            metaTags: [
              {
                name: 'description',
                content: 'Login to your account to experience Teemo.'
              },
              {
                property: 'og:description',
                content: 'Login to your account to experience Teemo.'
              }
            ]
        },
    },
    {
        path: '/dashboard',
        component: require('./views/application/Dashboard.vue').default,
        meta: {
            middlewareAuth: true,    
            title: 'Teemo - Dashboard',
            metaTags: [
              {
                name: 'description',
                content: 'Dashboard is a collection of your dashlets as set in your settings.'
              },
              {
                property: 'og:description',
                content: 'Dashboard is a collection of your dashlets as set in your settings.'
              }
            ]
        },
    },
    {
        path: '/clients',
        component: require('./views/application/clients/ClientsHome.vue').default,
        meta: {
            middlewareAuth: true,    
            title: 'Teemo - Client Management',
            metaTags: [
              {
                name: 'description',
                content: 'This page allows management of clients, create, update and browse all your clients with ease.'
              },
              {
                property: 'og:description',
                content: 'This page allows management of clients, create, update and browse all your clients with ease.'
              }
            ]
        },
    }
];


const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    
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