<template>
    <div
        v-if="wishlistEmpty == true"
        class="flex flex-col items-center p-8 mt-32 select-none"
    >
        <img
            src="../images/wishlist_empty.png"
            alt="empty-wishlist"
            class="w-600 pb-4"
        />
        <div class="flex flex-col gap-5 items-center font-mono">
            <h1 class="text-4xl antialiased font-bold text-center">
                Your wishlist is empty
            </h1>
            <span class="">Explore more and shortlist some items</span>
            <router-link to="/Products">
                <button
                    class="border p-2 rounded-lg bg-gray-800 text-white hover:bg-gray-700"
                >
                    Start Shopping
                </button>
            </router-link>
        </div>
    </div>

    <div v-else class="w-full h-full mt-32 mb-24 flex justify-center">
        <div class="shadow-xl mb-4">
            <div class="flex items-center justify-between p-4">
                <div class="flex text-2xl">
                    <h1 class="font-semibold">My Wishlist</h1>
                    <p class="text-gray-600 mx-3">
                        {{ "(" + productNumber + " items)" }}
                    </p>
                </div>
                <button
                    class="bg-gray-800 text-xl text-white px-2 border rounded-lg p-2"
                    @click="clearWishlist()"
                >
                    Clear all
                </button>
            </div>
            <hr />
            <div
                v-for="product in actualProducts"
                :key="product.id"
                class="flex py-8 px-2 gap-4 min-w-[550px]"
            >
                <img
                    :src="product.Img_src"
                    :alt="product.Img_alts"
                    :class="'w-28'"
                />
                <div class="flex flex-col w-full flex-wrap justify-center">
                    <div class="flex justify-between">
                        <p class="text-green-600 font-semibold">In Stock</p>
                        <button
                            @click="removeItem(product.Product_name)"
                            class=""
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                    <h2 class="my-1 font-semibold">
                        {{ product.Product_name }}
                    </h2>
                    <div class="flex justify-between">
                        <div class="">
                            <p class="text-gray-600">
                                {{ product.Category }}
                            </p>
                            <p class="font-bold">
                                {{ product.Price + "$" }}
                            </p>
                        </div>
                        <router-link
                            :to="{
                                name: 'ProductPage',
                                params: {
                                    productName: product.Product_name,
                                },
                            }"
                            class="border px-4 flex text-sm rounded-lg bg-gray-800 hover:bg-gray-700 text-white"
                        >
                            <button>Add To Cart</button>
                        </router-link>
                    </div>
                </div>
                <hr />
            </div>
        </div>
    </div>
</template>

<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { ref, onMounted } from "vue";
import axios from "axios";

export default {
    setup() {
        const actualProducts = ref([]);
        onMounted(() => {
            axios
                .get("/api/posts")
                .then((resp) => {
                    const duplicates = resp.data.filter((obj) =>
                        wishlist.value.some((Name) => obj.Product_name === Name)
                    );
                    actualProducts.value = duplicates;
                })
                .catch((error) => {
                    console.log(error);
                });
        });
        const wishlist = ref(
            JSON.parse(localStorage.getItem("wishlist")) || []
        );

        const productNumber = ref(wishlist.value.length);
        const wishlistEmpty = ref(wishlist.value.length === 0);

        const removeItem = () => {
            const actualProducts = JSON.parse(
                localStorage.getItem("wishlist") || "[]"
            );
            axios
                .get("/api/posts")
                .then((resp) => {
                    const filteringWishFromProd = resp.data.filter(
                        (obj) => obj.Product_name == actualProducts
                    );
                    if (filteringWishFromProd) {
                        const hi = filteringWishFromProd.value;
                        actualProducts.splice(hi, 1);
                        toast.success("Success! Item removed from wishlist.", {
                            autoClose: 5000,
                        });
                        localStorage.setItem(
                            "wishlist",
                            JSON.stringify(actualProducts)
                        );
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        };

        const clearWishlist = () => {
            localStorage.removeItem("wishlist");
            wishlist.value = [];
            wishlistEmpty.value = true;
        };

        return {
            actualProducts,
            wishlistEmpty,
            wishlist,
            removeItem,
            productNumber,
            clearWishlist,
        };
    },
};
</script>
