<template>
    <div v-if="cartEmpty == false">
        <div
            class="w-full h-full top-0 overflow-y-hidden max-lg:overflow-y-auto overflow-x-hidden sticky-0 max-lg:mt-16"
        >
            <div
                class="w-full z-10 right-0 h-full overflow-x-hidden overflow-y-hidden max-lg:overflow-y-auto transform translate-x-0 transition ease-in-out duration-700"
            >
                <div class="flex items-end lg:flex-row flex-col justify-end">
                    <div
                        class="mt-10 bg-white w-full w-full lg:px-8 lg:py-14 md:px-6 px-4 md:py-8 py-4e overflow-y-auto overflow-x-hidden lg:h-screen h-auto"
                    >
                        <div class="flex items-center justify-between">
                            <p
                                class="text-3xl font-black leading-10 text-gray-800"
                            >
                                Bag
                            </p>
                            <button
                                class="p-2 rounded-xl border bg-gray-800 text-white hover:bg-gray-600 font-bold text-xl"
                                @click="clearCart()"
                            >
                                Clear Cart
                            </button>
                        </div>
                        <div
                            ref="products"
                            class="md:flex flex-col items-stretch border-t border-gray-50"
                        >
                            <div
                                v-for="product in actualProducts"
                                :key="product.id"
                                class="md:flex items-stretch py-8 md:py-10 lg:py-8 border-t border-gray-50"
                            >
                                <div
                                    class="md:w-4/12 max-md:flex max-md:justify-center 2xl:w-1/4 w-full"
                                >
                                    <img
                                        :src="product.Img_src"
                                        :alt="product.Img_alts"
                                        class="h-64 w-64 object-contain md:block hidden"
                                    />
                                </div>
                                <div
                                    class="md:pl-3 md:w-8/12 2xl:w-3/4 flex flex-col justify-center"
                                >
                                    <p
                                        class="text-xs leading-3 text-gray-800 md:pt-0 pt-4"
                                    >
                                        {{ product.Code }}
                                    </p>
                                    <div
                                        class="flex items-center justify-between w-full pt-1"
                                    >
                                        <p
                                            class="text-base max-w-[75%] py-2 font-black leading-none text-gray-800"
                                        >
                                            {{ product.Product_name }}
                                        </p>
                                    </div>
                                    <p
                                        class="text-xs leading-3 text-gray-600 py-2"
                                    >
                                        Quantity: {{ product.Quantity }}
                                    </p>
                                    <p
                                        class="text-xs leading-3 text-gray-600 py-2"
                                    >
                                        {{ product.code }}: {{ product.Size }}
                                    </p>
                                    <div
                                        class="flex py-2 items-center justify-between"
                                    >
                                        <div class="flex items-center gap-1.5">
                                            <button
                                                @click="
                                                    addToWishlist(
                                                        product.Product_name
                                                    )
                                                "
                                                class="text-xs leading-3 underline text-gray-800 cursor-pointer"
                                            >
                                                Add To Wishlist
                                            </button>
                                            <button
                                                @click="removeItem()"
                                                class="text-xs leading-3 underline text-red-500 pl-5 cursor-pointer"
                                            >
                                                Remove
                                            </button>
                                        </div>
                                        <p
                                            class="text-base font-black leading-none text-gray-800"
                                        >
                                            {{ product.Price }}$
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-4/12 max-lg:w-full bg-gray-100 h-full">
                        <div
                            class="flex max-lg:mb-14 flex-col lg:h-screen h-auto lg:px-8 md:px-7 px-4 lg:py-20 md:py-10 py-6 justify-between overflow-y-auto"
                        >
                            <div>
                                <div class="flex justify-between">
                                    <p
                                        class="lg:text-4xl text-3xl font-black leading-9 text-gray-800"
                                    >
                                        Summary
                                    </p>
                                    <Router-Link to="/">
                                        <button class="flex mt-2.5">
                                            <i
                                                class="fa-sharp fa-solid fa-2x fa-xmark"
                                            ></i>
                                        </button>
                                    </Router-Link>
                                </div>
                                <div
                                    class="flex items-center justify-between pt-16"
                                >
                                    <p
                                        class="text-base leading-none text-gray-800"
                                    >
                                        Subtotal
                                    </p>
                                    <p
                                        class="text-base leading-none text-gray-800"
                                    >
                                        {{ totalPrice }}$
                                    </p>
                                </div>
                                <div
                                    class="flex items-center justify-between pt-5"
                                >
                                    <p
                                        class="text-base leading-none text-gray-800"
                                    >
                                        Shipping
                                    </p>
                                    <p
                                        class="text-base leading-none text-gray-800"
                                    >
                                        {{ Shipping }}$
                                    </p>
                                </div>
                                <div
                                    class="flex items-center justify-between pt-5"
                                >
                                    <p
                                        class="text-base leading-none text-gray-800"
                                    >
                                        Tax
                                    </p>
                                    <p
                                        class="text-base leading-none text-gray-800"
                                    >
                                        {{ tax }}$
                                    </p>
                                </div>
                            </div>
                            <div>
                                <div
                                    class="flex items-center pb-6 justify-between lg:pt-5 pt-20"
                                >
                                    <p
                                        class="text-2xl leading-normal text-gray-800"
                                    >
                                        Total
                                    </p>
                                    <p
                                        class="text-2xl font-bold leading-normal text-right text-gray-800"
                                    >
                                        {{ grandTotal }}$
                                    </p>
                                </div>
                                <RouterLink to="/Checkout">
                                    <button
                                        class="text-base leading-none w-full py-5 bg-gray-800 border-gray-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-white"
                                    >
                                        Checkout
                                    </button>
                                </RouterLink>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="max-sm:flex hidden max-lg:mb-14 flex-col lg:h-screen h-auto lg:px-8 md:px-7 px-4 lg:py-20 md:py-10 py-6 justify-between overflow-y-auto"
        >
            <div>
                <div class="flex justify-between">
                    <p
                        class="lg:text-4xl text-3xl font-black leading-9 text-gray-800"
                    >
                        Summary
                    </p>
                    <Router-Link to="/">
                        <button class="flex mt-2.5">
                            <i class="fa-sharp fa-solid fa-2x fa-xmark"></i>
                        </button>
                    </Router-Link>
                </div>
                <div class="flex items-center justify-between pt-16">
                    <p class="text-base leading-none text-gray-800">Subtotal</p>
                    <p class="text-base leading-none text-gray-800">
                        {{ totalPrice }}$
                    </p>
                </div>
                <div class="flex items-center justify-between pt-5">
                    <p class="text-base leading-none text-gray-800">Shipping</p>
                    <p class="text-base leading-none text-gray-800">
                        {{ Shipping }}$
                    </p>
                </div>
                <div class="flex items-center justify-between pt-5">
                    <p class="text-base leading-none text-gray-800">Tax</p>
                    <p class="text-base leading-none text-gray-800">
                        {{ tax }}$
                    </p>
                </div>
            </div>
            <div>
                <div
                    class="flex items-center pb-6 justify-between lg:pt-5 pt-20"
                >
                    <p class="text-2xl leading-normal text-gray-800">Total</p>
                    <p
                        class="text-2xl font-bold leading-normal text-right text-gray-800"
                    >
                        {{ grandTotal }}$
                    </p>
                </div>
                <RouterLink to="/Checkout">
                    <button
                        class="text-base leading-none w-full py-5 bg-gray-800 border-gray-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-white"
                    >
                        Checkout
                    </button>
                </RouterLink>
            </div>
        </div>
    </div>
    <div
        v-else
        class="w-full h-full flex flex-col items-center p-8 select-none max-sm:mt-5"
    >
        <img src="../images/empty.png" class="w-800" />
        <div class="flex flex-col items-center gap-7">
            <div class="flex flex-col items-center font-mono">
                <p class="text-2xl antialiased font-bold mb-4">
                    You have no items in your shopping cart.
                </p>
                <p class="text-xl antialiased">Let's go buy something!</p>
            </div>
            <router-link to="/Products">
                <button
                    class="rounded-lg border p-2 px-4 bg-gray-800 text-white hover:bg-gray-700"
                >
                    Shop Now
                </button>
            </router-link>
        </div>
    </div>
</template>

<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { ref } from "vue";
import { toggleLikeBtn } from "../js/App.vue";

export default {
    setup() {
        const actualProducts =
            JSON.parse(localStorage.getItem("CartProducts")) || [];
        const savedProducts =
            JSON.parse(localStorage.getItem("tempProducts")) || [];
        const wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
        const Shipping = 25;
        const prices = [];
        const tax = 35;

        let cartEmpty;
        if (actualProducts.length === 0) {
            cartEmpty = ref(true);
        } else {
            cartEmpty = ref(false);
        }

        actualProducts.forEach((element) => {
            const price = element.Quantity * element.Price;
            prices.push(price);
        });

        const totalPrice = prices.reduce((acc, curr) => acc + curr, 0);
        const grandTotal = totalPrice + Shipping + tax;

        if (savedProducts.length > 0) {
            const namesAndAgesArray = savedProducts.map((obj) => ({
                Name: obj.Name,
                Size: obj.Size,
                Quantity: obj.Quantity,
            }));
            axios.get("/api/posts").then((resp) => {
                console.log(resp.data);
                const duplicatesArray = resp.data.filter((obj) => {
                    const matchingObj = namesAndAgesArray.find(
                        (item) => item.Name === obj.Product_name
                    );
                    if (matchingObj) {
                        obj.Size = matchingObj.Size;
                        obj.Quantity = matchingObj.Quantity;
                        return true;
                    }
                    return false;
                });
                localStorage.setItem(
                    "CartProducts",
                    JSON.stringify(duplicatesArray)
                );
            });
        }

        const clearCart = () => {
            localStorage.removeItem("CartProducts");
            localStorage.removeItem("tempProducts");
            toast.success("Cart has been emptied! Please refresh.", {
                autoClose: 5000,
            });
        };

        const addToWishlist = (productName) => {
            toggleLikeBtn(wishlist, productName);
        };

        const removeItem = () => {
            axios
                .get("/api/posts")
                .then((resp) => {
                    actualProducts.forEach((product) => {
                        const filter = resp.data.filter((element) => {
                            return (
                                product.Product_name === element.Product_name
                            );
                        });
                        if (filter) {
                            const hi = filter[0].Product_name;
                            savedProducts.splice(hi, 1);
                            actualProducts.splice(hi, 1);

                            toast.success(
                                "Success! Item has been removed from Cart.",
                                {
                                    autoClose: 5000,
                                }
                            );
                            localStorage.setItem(
                                "tempProducts",
                                JSON.stringify(savedProducts)
                            );
                            localStorage.setItem(
                                "CartProducts",
                                JSON.stringify(actualProducts)
                            );
                        }
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        };

        return {
            tax,
            prices,
            totalPrice,
            grandTotal,
            cartEmpty,
            clearCart,
            Shipping,
            actualProducts,
            addToWishlist,
            removeItem,
        };
    },
};
</script>
