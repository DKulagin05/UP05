import { createRouter, createWebHistory } from 'vue-router'
import MainPage from "@/pages/MainPage.vue"
import SalePage from "@/pages/PromotionsPage.vue"
import AboutPage from "@/pages/AboutPage.vue"
import ProfilePage from "@/pages/ProfilePage.vue"
import HotelsPage from "@/pages/HotelsPage.vue"
import AdminPage from "@/pages/AdminPage.vue"
import ServicesPage from "@/pages/ServicesPage.vue"
import AuthPage from "@/pages/AuthPage.vue"
import Logout from "@/pages/Logout.vue"
import ReviewsPage from "@/pages/ReviewsPage.vue"

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: MainPage
        },
        {
            path: '/sale',
            name: 'sale',
            component: SalePage
        },
        {
            path: '/about',
            name: 'AboutPage',
            component: AboutPage
        },
        {
            path: '/profile',
            name: 'ProfilePage',
            component: ProfilePage
        },
        {
            path: '/hotels',
            name: 'HotelsPage',
            component: HotelsPage
        },
        {
            path: '/admin',
            name: 'AdminPage',
            component: AdminPage
        },
        {
            path: '/services',
            name: 'services',
            component: ServicesPage
        },
        {
            path: '/auth',
            name: 'auth',
            component: AuthPage
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout
        },
        {
            path: '/reviews',
            name: 'ReviewsPage',
            component: ReviewsPage
        },
    ]
})

export default router