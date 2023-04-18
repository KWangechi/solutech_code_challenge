import { createWebHistory, createRouter } from 'vue-router'
// import store from '@/store'

const ExampleComponent = () => import('../components/ExampleComponent.vue')
const Dashboard = () => import('../components/Dashboard.vue')

const Login = () => import('../components/auth/Login.vue')
const Register = () => import('../components/auth/Register.vue')


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
        name: "example",
        path: "/",
        component: ExampleComponent,

    },
    {
        name: "dashboard",
        path: "/dashboard",
        component: Dashboard,
    },
    {
        name: "login",
        path: "/login",
        component: Login,
    },
    {
        name: "register",
        path: "/register",
        component: Register,
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// router.beforeEach((to, from, next) => {
//     document.title = to.meta.title
//     if (to.meta.middleware == "guest") {
//         if (store.state.auth.authenticated) {
//             next({ name: "dashboard" })
//         }
//         next()
//     } else {
//         if (store.state.auth.authenticated) {
//             next()
//         } else {
//             next({ name: "login" })
//         }
//     }
// })

export default router
