import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginComponent from "../views/login.vue"
import HomeComponent from "../views/Home"
import AboutComponent from "../views/About"
import SBookManagement from "../views/SBookManage"
import AUserManagement from "../views/AUserManage"
import StaffVerification from "../views/StaffVerification"
import Register from "../views/Register"
import NewEmployee from "../views/NewEmployee"
import NewBook from "../views/NewBook"
import Category from "../views/Category"
import Home from "../views/Home"
import Rented from "../views/Rented"
import store from "../store";
import AdminLoginComponent from "../views/AdminLogin"
import StaffLoginComponent from "../views/StaffLogin"

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        redirect: {
            name: "Home"
        },
        component: Home
    },
    {
        path: "/Category",
        name: "Category",
        component: Category,
        meta: { requiresAuth: true },
    },
    {
        path: "/Rented",
        name: "Rented",
        component: Rented,
        meta: { requiresAuth: true },
    },
    {
        path: "/NewBook",
        name: "NewBook",
        component: NewBook,
        meta: { requiresAuth: true },
    },
    {
        path: "/NewEmployee",
        name: "NewEmployee",
        component: NewEmployee,
        meta: { requiresAuth: true },
    },
    {
        path: "/Register",
        name: "Register",
        component: Register,
        meta: { guest: true },
    },
    {
        path: "/",
        name: "Home",
        component: HomeComponent,
    },
    {
        path: "/login",
        name: "login",
        component: LoginComponent,
        meta: { guest: true },
    },
    {
        path: "/adminlogin",
        name: "AdminLogin",
        component: AdminLoginComponent,
        meta: { guest: true },
    },
    {
        path: "/stafflogin",
        name: "StaffLogin",
        component: StaffLoginComponent,
        meta: { guest: true },
    },
    {
        path: "/About",
        name: "about",
        component: AboutComponent,
    },
    {
        path: "/SBookManage",
        name: "sbookmanage",
        component: SBookManagement,
        meta: { requiresAuth: true },
    },
    {
        path: "/AUserManage",
        name: "ausermanage",
        component: AUserManagement,
        meta: { requiresAuth: true },
    },
    {
        path: "/StaffVerification",
        name: "StaffVerification",
        component: StaffVerification,
        meta: { requiresAuth: true },
    }
]

const router = new VueRouter({
    //mode: "history",
    base: process.env.BASE_URL,
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (store.getters.isAuthenticated) {
            next();
            return;
        }
        next("/login");
    } else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.guest)) {
        if (store.getters.isAuthenticated) {
            next("/");
            return;
        }
        next();
    } else {
        next();
    }
});

export default router;