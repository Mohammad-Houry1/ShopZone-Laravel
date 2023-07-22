<template>
    <div class="mt-28 mb-28">
        <div
            v-for="displayedProducts in displayedProducts"
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
        >
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <router-link
                            to="/"
                            class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-800 hover:text-gray-500"
                        >
                            <i class="fa-solid fa-house"></i>
                            Home
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/Products">
                            <div class="flex items-center">
                                <i class="fa-solid fa-chevron-right"></i>
                                <span
                                    class="ml-1 text-sm font-medium text-gray-800 hover:text-gray-500 md:ml-2"
                                    >Products</span
                                >
                            </div>
                        </router-link>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span
                                class="ml-1 text-sm font-medium text-gray-800 md:ml-2 dark:text-gray-700"
                                >{{ displayedProducts.Product_name }}</span
                            >
                        </div>
                    </li>
                </ol>
            </nav>
            <div
                :id="displayedProducts.id"
                class="flex flex-col md:flex-row gap-5 -mx-4 shadow-xl p-6 rounded-xl"
            >
                <img
                    :src="displayedProducts.Img_src"
                    :alt="displayedProducts.Img_alts"
                    class="md:flex-1 object-contain w-500 px-4 h-500"
                />
                <div class="flex flex-col justify-center">
                    <h2
                        class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl"
                        id="productName"
                    >
                        {{ displayedProducts.Product_name }}
                    </h2>
                    <p class="text-gray-500 text-sm">
                        {{ displayedProducts.Brand }}
                    </p>
                    <p class="text-gray-500 my-2">
                        {{ displayedProducts.Description }}
                    </p>
                    <details class="p-4 rounded-xl border my-2 cursor-pointer">
                        <summary>Product Details:</summary>
                        <li
                            v-for="high in productDetails"
                            :key="high"
                            :value="high"
                            class="text-gray-400"
                        >
                            <span class="text-gray-600">
                                {{ displayedProducts["highlight" + high] }}
                            </span>
                        </li>
                    </details>
                    <div class="flex font-mono gap-2.5 mb-3">
                        <div class="flex flex-col w-2/4">
                            <span class="text-3xl mb-2"
                                >{{ displayedProducts.code }}:</span
                            >
                            <select
                                class="border rounded-xl p-2"
                                id="size"
                                data-te-select-init
                            >
                                <option
                                    v-for="size in sizes"
                                    :key="size"
                                    :value="displayedProducts['size' + size]"
                                >
                                    {{ displayedProducts["size" + size] }}
                                </option>
                            </select>
                        </div>
                        <div class="flex flex-col w-2/4">
                            <span class="text-3xl mb-2">Quantity:</span>
                            <input
                                type="number"
                                value="1"
                                max="100"
                                min="1"
                                id="qte"
                                class="border rounded-xl p-2"
                            />
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 my-4">
                        <div>
                            <div class="rounded-lg bg-gray-100 flex py-2 px-3">
                                <span class="text-gray-400 mr-1 mt-1">$</span>
                                <span
                                    class="font-bold text-gray-800 text-3xl"
                                    >{{ displayedProducts.Price }}</span
                                >
                            </div>
                        </div>
                    </div>

                    <div class="flex py-4 gap-1.5">
                        <button
                            class="w-full px-6 py-2 font-semibold rounded-xl bg-gray-800 hover:bg-gray-700 text-white"
                            @click="addToCart(displayedProducts.Product_name)"
                        >
                            Add to Cart
                        </button>
                        <button
                            @click="
                                addToWishlist(displayedProducts.Product_name)
                            "
                            class="p-4 border bg-gray-800 hover:bg-gray-700 rounded-xl"
                        >
                            <i
                                class="fa-solid fa-heart"
                                style="color: #ffffff"
                            ></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, onMounted } from "vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { toggleLikeBtn } from "../js/App.vue";
import { useRoute } from "vue-router";

export default {
    setup() {
        const sizes = ref([1, 2, 3, 4, 5]);
        const productDetails = ref([1, 2, 3]);
        const displayedProducts = ref([]);
        const route = useRoute();
        const params = ref(route.params.productName).value;
        onMounted(() => {
            axios.get("/api/posts").then((resp) => {
                const finalProduct = resp.data.filter(
                    (product) => product.Product_name === params
                );
                displayedProducts.value = finalProduct;
            });
        });

        const wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
        const cartProducts =
            JSON.parse(localStorage.getItem("tempProducts")) || [];

        const addToCart = (productName) => {
            let productSize = $("#size")[0].value;
            let productQte = $("#qte")[0].value;
            let product = {
                Name: productName,
                Size: productSize,
                Quantity: productQte,
            };
            let hasDuplicate = false;

            cartProducts.forEach((element, index) => {
                if (
                    element.Name === productName &&
                    element.Size === productSize
                ) {
                    element.Quantity =
                        parseInt(element.Quantity) + parseInt(productQte);
                    cartProducts.splice(index, 1, element);
                    hasDuplicate = true;
                    return;
                }
            });

            if (hasDuplicate) {
                localStorage.setItem(
                    "tempProducts",
                    JSON.stringify(cartProducts)
                );
                toast.info("Info! Cart item has been changed.", {
                    autoClose: 5000,
                });
            } else {
                cartProducts.push(product);
                localStorage.setItem(
                    "tempProducts",
                    JSON.stringify(cartProducts)
                );
                toast.success("Success! Item added to cart.", {
                    autoClose: 5000,
                });
            }
        };
        const addToWishlist = (productName) => {
            toggleLikeBtn(wishlist, productName);
        };

        return {
            sizes,
            displayedProducts,
            addToCart,
            wishlist,
            cartProducts,
            addToWishlist,
            productDetails,
            params,
            route,
        };
    },
};
</script>
