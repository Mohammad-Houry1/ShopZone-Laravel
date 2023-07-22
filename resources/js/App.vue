<template>
    <navbar />
    <RouterView />
    <foter />
</template>

<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { RouterView } from "vue-router";
import Navbar from "../components/Navbar.vue";
import Foter from "../components/Foter.vue";

export default {
    name: "App",
    components: {
        Navbar,
        Foter,
    },
};

export const toggleLikeBtn = (wishlist, productName) => {
    if (wishlist.includes(productName)) {
        toast.error("Error! Item already in wishlist.", {
            autoClose: 5000,
        });
        return;
    } else {
        toast.success("Success! Item added to wishlist.", {
            autoClose: 5000,
        });
        wishlist.push(productName);
        localStorage.setItem("wishlist", JSON.stringify(wishlist));
    }
};
</script>
