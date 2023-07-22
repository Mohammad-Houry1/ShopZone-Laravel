import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";

import App from "./App.vue";
import Home from "../components/home.vue";
import Product from "../components/product.vue";
import ProductPage from "../components/productpage.vue";
import Contact from "../components/Contact.vue";
import About from "../components/About.vue";
import wishlist from "../components/wishlist.vue";
import cart from "../components/cart.vue";
import checkout from "../components/checkout.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/ProductPage/:productName",
        name: "ProductPage",
        component: ProductPage,
    },
    { path: "/Products", name: "Products", component: Product },
    { path: "/Contact", name: "Contact us", component: Contact },
    { path: "/About", name: "About", component: About },
    { path: "/Wishlist", name: "Wishlist", component: wishlist },
    { path: "/Cart", name: "Cart", component: cart },
    { path: "/Checkout", name: "checkout", component: checkout },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App).use(router).mount("#app");
