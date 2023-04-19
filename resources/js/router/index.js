import { createWebHistory, createRouter } from "vue-router";
import { useUsers } from "../store/users";

// const ExampleComponent = () => import("../components/ExampleComponent.vue");

const Login = () => import("../components/auth/Login.vue");
const Register = () => import("../components/auth/Register.vue");

const Dashboard = () => import("../components/Dashboard.vue");
const Users = () => import("../components/users/Index.vue")
const StatusIndex = () => import("../components/status/Index.vue");


// const useStore = useUsers();

// /* Guest Component */
// const Login = () => import('@/components/Login.vue')
// const Register = () => import('@/components/Register.vue')
/* Guest Component */

// /* Layouts */
// const DahboardLayout = () => import('@/components/layouts/Default.vue')
// /* Layouts */

// /* Authenticated Component */
// const Dashboard = () => import('@/components/Dashboard.vue')
// /* Authenticated Component */

const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`,
        },
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`,
        },
    },
    {
        name: "dashboard",
        path: "/dashboard",
        component: Dashboard,
        meta: {
            title: `Users Dashboard`
        },
        children: [
            {
                name: 'users',
                path: '/users',
                component: Users
            },

            {
                name: "status",
                path: "/status",
                component: StatusIndex,
                children: [
                    {
                        name: 'tasks_create',
                        path: '/create'
                    }
                ],

                meta: {
                    title: `Status Dashboard`
                }
            },
        ]
    },
    // {
    //     name: "tasks",
    //     path: "/tasks",
    //     component: TasksDashboard,
    //     children: [
    //         {
    //             name: 'tasks_create',
    //             path: '/create'
    //         }
    //     ],

    //     meta: {
    //         title: `Tasks Dashboard`
    //     }
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// protect the dashboard and example component pages
router.beforeEach((to, from, next) => {
    const useStore = useUsers();

    console.log(useStore.$state.userAuthenticated);
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        if (useStore.$state.userAuthenticated) {
            next({ name: "example" })
        }
        next()
    } else {
        if (useStore.$state.userAuthenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
});

export default router;
