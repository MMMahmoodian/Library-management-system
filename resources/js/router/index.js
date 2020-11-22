import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginComponent from "../views/login.vue"
import SecureComponent from "../views/secure.vue"
import HomeComponent from "../views/Home"
import AboutComponent from "../views/About"
import SBookManagement from "../views/SBookManage"
import AUserManagement from "../views/AUserManage"
import StaffVerification from "../views/StaffVerification"
import Register from "../views/Register"
import NewEmployee from "../views/NewEmployee"
import NewBook from "../views/NewBook"
import Category from "../views/Category"

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {
            path: '/',
            redirect: {
                name: "Home"
            }
        },
        {
            path: "/Category",
            name: "Category",
            component: Category
        },
        {
            path: "/NewBook",
            name: "NewBook",
            component: NewBook
        },
        {
            path: "/NewEmployee",
            name: "NewEmployee",
            component: NewEmployee
        },
        {
            path: "/Register",
            name: "Register",
            component: Register
        },
        {
            path: "/",
            name: "Home",
            component: HomeComponent
        },
        {
            path: "/login",
            name: "login",
            component: LoginComponent
        },
        {
            path: "/secure",
            name: "secure",
            component: SecureComponent
        },
        {
            path: "/About",
            name: "about",
            component: AboutComponent
        },
        {
            path: "/SBookManage",
            name: "sbookmanage",
            component: SBookManagement
        },
        {
            path: "/AUserManage",
            name: "ausermanage",
            component: AUserManagement
        },
        {
            path: "/StaffVerification",
            name: "StaffVerification",
            component: StaffVerification
        }
    ]
})