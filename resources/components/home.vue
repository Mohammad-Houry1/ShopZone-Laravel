<template>
    <swiper
        :loop="true"
        :autoplay="{
            delay: 2500,
        }"
        :pagination="pagination"
        :modules="modules"
        class="mySwiper mt-20 bg-gray-200"
    >
        <swiper-slide v-for="prod in imgProd">
            <img
                class="object-contain"
                :src="prod.Img_src"
                :alt="prod.Img_alts"
            />
        </swiper-slide>
    </swiper>

    <div class="mb-32">
        <div class="p-2">
            <h1
                class="text-3xl text-center p-4 antialiased font-semibold font-mono"
            >
                Latest Product
            </h1>
            <hr class="style14" />
        </div>
        <div class="mx-auto max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8">
            <div
                class="mt-6 max-sm:p-4 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"
            >
                <div
                    v-for="product in displayedProducts"
                    :key="product.id"
                    class="shadow-md relative overflow-hidden border rounded-lg flex flex-col transform transition-transform duration-300 hover:scale-105"
                >
                    <div class="flex-shrink-0 bg-gray-200 p-4">
                        <img
                            :src="product.Img_src"
                            :alt="product.Img_alts"
                            class="w-[300px] h-[300px] object-contain mx-auto border-b"
                        />
                    </div>
                    <div class="p-4 flex flex-col justify-between flex-grow">
                        <div class="flex flex-col justify-start flex-grow">
                            <p class="text-gray-500 text-center">
                                <span class="font-bold">{{
                                    product.Category
                                }}</span>
                            </p>
                            <h3
                                class="text-lg font-medium text-gray-900 text-center my-2"
                                id="productName"
                            >
                                {{ product.Product_name }}
                            </h3>
                            <div
                                class="flex items-center justify-between mt-auto"
                            >
                                <span class="font-bold text-gray-900"
                                    >${{ product.Price }}</span
                                >
                                <div class="flex items-center space-x-2">
                                    <router-link
                                        class="flex gap-1 items-center"
                                        :to="{
                                            name: 'ProductPage',
                                            params: {
                                                productName:
                                                    product.Product_name,
                                            },
                                        }"
                                    >
                                        <button
                                            class="rounded-lg bg-gray-800 relative z-[999] text-white p-2 hover:bg-gray-700 btn"
                                        >
                                            Add to Cart
                                        </button>
                                    </router-link>

                                    <button
                                        class="p-2 rounded-lg border relative z-[999]"
                                        @click="
                                            addToWishlist(product.Product_name)
                                        "
                                        ref="likeBtn"
                                    >
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="style14 my-6" />
        <div class="flex my-5 justify-center">
            <router-link to="/Products">
                <h1 class="font-mono">View All Products ></h1>
            </router-link>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Pagination, Autoplay } from "swiper";
import { toggleLikeBtn } from "../js/App.vue";
import "swiper/css";
import "swiper/css/pagination";
import "../css/app.css";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        const wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
        const displayedProducts = ref([]);
        const imgProd = ref([]);

        onMounted(() => {
            axios
                .get("/api/posts")
                .then((resp) => {
                    displayedProducts.value = resp.data.slice(0, 8);
                    imgProd.value = resp.data.slice(14, 18);
                })
                .catch((error) => {
                    console.log(error);
                });
        });

        const addToWishlist = (productName) => {
            toggleLikeBtn(wishlist, productName);
        };

        return {
            displayedProducts,
            addToWishlist,
            imgProd,
            pagination: {
                clickable: true,
                loop: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '"></span>';
                },
            },
            autoplay: {
                delay: 100,
            },
            modules: [Pagination, Autoplay],
        };
    },
};
</script>
