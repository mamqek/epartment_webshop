import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        redirect: "/item/1"
    },
    {
        path: "/item/:id",
        component: () => import("./pages/ItemPage.vue"),
    },
    {
        path: "/cart",
        component: () => import("./pages/CartPage.vue"),
    },
];


export default createRouter({
    history: createWebHistory(),
    routes,
});