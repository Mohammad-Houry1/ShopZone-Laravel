<template>
    <section
        id="navbar"
        class="select-none z-[999] fixed top-0 z-10 mx-auto shadow-xl bg-gray-900"
    >
        <nav class="flex justify-between text-white w-screen">
            <div
                class="px-5 xl:px-12 py-6 flex w-full items-center max-md:w-9/12"
            >
                <div
                    id="searchBar"
                    class="hidden flex-col items-center left-0 p-4 fixed max-md:hidden w-full top-0 justify-center bg-gray-900 text-white"
                >
                    <div class="border p-2 rounded-lg items-center w-9/12">
                        <div class="w-full">
                            <div class="flex justify-between w-full">
                                <input
                                    class="focus:outline-0 bg-inherit w-full"
                                    placeholder="Search..."
                                    type="text"
                                    v-model="searchQuery"
                                    @input="filteredItems"
                                />
                                <div class="flex gap-3 items-center">
                                    <button @click="search">
                                        <i
                                            class="fa-solid fa-magnifying-glass"
                                        ></i>
                                    </button>
                                    <button @click="toggleSearch" class="flex">
                                        <i
                                            class="fa-solid text-xl fa-xmark"
                                        ></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="w-full" v-if="searchQuery !== ''">
                        <li
                            class="hover:bg-gray-800 cursor-pointer text-center"
                            v-for="suggestion in filteredItems"
                            :key="suggestion"
                            @click="selectSuggestion(suggestion)"
                        >
                            {{ suggestion.Product_name }}
                        </li>
                    </ul>
                </div>

                <div class="text-3xl font-bold font-heading">
                    <router-link to="/">
                        <img
                            class="h-9 pl-4"
                            src="../images/shopzone-low-resolution-logo-white-on-transparent-background.png"
                            alt="logo"
                        />
                    </router-link>
                </div>
                <ul
                    class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12"
                >
                    <li
                        class="cursor-pointer text-lg hover:transition-all hover:underline"
                    >
                        <router-link to="/Products">
                            <span>Products</span>
                        </router-link>
                    </li>
                    <li
                        class="cursor-pointer text-lg hover:transition-all hover:underline"
                    >
                        <router-link to="/Wishlist">
                            <span>Wish List</span>
                        </router-link>
                    </li>
                    <li
                        class="cursor-pointer text-lg hover:transition-all hover:underline"
                    >
                        <router-link to="/Contact">
                            <span>Contact us</span>
                        </router-link>
                    </li>
                    <li
                        class="cursor-pointer text-lg hover:transition-all hover:underline"
                    >
                        <router-link to="/About">
                            <span>About me</span>
                        </router-link>
                    </li>
                </ul>
                <div class="hidden md:flex items-center space-x-5 items-center">
                    <button @click="toggleSearch()">
                        <i class="fa-solid fa-magnifying-glass text-xl"></i>
                    </button>
                    <button>
                        <router-link to="/Cart">
                            <i class="fa-solid fa-cart-shopping text-xl"></i>
                        </router-link>
                    </button>
                </div>
            </div>

            <div
                class="fixed top-0 right-[-100%] w-full bg-gray-900 h-screen text-center z-[999] md:hidden"
                id="container"
            >
                <div
                    class="text-2xl float-right m-5 text-white rotate-45 cursor-pointer text-6xl"
                    @click="closeMenu()"
                >
                    +
                </div>
                <ul
                    class="absolute top-1/2 left-2/4 transform -translate-x-2/4 -translate-y-2/4 list-none opacity-0 text-center text-white"
                    id="menu"
                >
                    <li
                        class="my-4 hover:text-white transition duration-500 hover:scale-125 hover:bg-gray-800 p-4 text-3xl"
                    >
                        <button>
                            <router-link to="/" @click="closeMenu()">
                                <span>Home</span>
                            </router-link>
                        </button>
                    </li>
                    <li
                        class="my-4 hover:text-white transition duration-500 hover:scale-125 hover:bg-gray-800 p-4 text-3xl"
                    >
                        <router-link to="/Products" @click="closeMenu()">
                            <span>Products</span>
                        </router-link>
                    </li>
                    <li
                        class="my-4 hover:text-white transition duration-500 hover:scale-125 hover:bg-gray-800 p-4 text-3xl"
                    >
                        <button>
                            <router-link to="/Wishlist" @click="closeMenu()">
                                <span>Wishlist</span>
                            </router-link>
                        </button>
                    </li>
                    <li
                        class="my-4 hover:text-white transition duration-500 hover:scale-125 hover:bg-gray-800 p-4 text-3xl"
                    >
                        <button>
                            <router-link to="/Contact" @click="closeMenu()">
                                <span>Contact us</span>
                            </router-link>
                        </button>
                    </li>
                    <li
                        class="my-4 hover:text-white transition duration-500 hover:scale-125 hover:bg-gray-800 p-4 text-3xl"
                    >
                        <button>
                            <router-link to="/About" @click="closeMenu()">
                                <span>About me</span>
                            </router-link>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="flex gap-3 items-center pr-6 md:hidden">
                <button>
                    <router-link to="/Cart">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                    </router-link>
                </button>

                <button @click="openMenu()">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>
        </nav>
    </section>
</template>

<script>
import { ref, computed, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default {
    setup() {
        const resp = ref([]);
        const searchQuery = ref("");
        const showSuggestions = ref(true);

        const router = useRouter();

        const search = () => {
            if (searchQuery.value) {
                toggleSearch();
                router.push({
                    name: "ProductPage",
                    params: {
                        productName: searchQuery.value,
                    },
                });
            }
        };
        onMounted(() => {
            axios.get("/api/posts").then((response) => {
                resp.value = response.data;
            });
        });

        const filteredItems = computed(() => {
            if (searchQuery.value === "") {
                return [];
            }
            return resp.value.filter((item) => {
                return item.Product_name.toLowerCase().includes(
                    searchQuery.value.toLowerCase()
                );
            });
        });

        const toggleSearch = () => {
            const searchBar = document.getElementById("searchBar");
            searchBar.classList.toggle("flx");
        };

        const selectSuggestion = (suggestion) => {
            searchQuery.value = suggestion.Product_name;
            showSuggestions.value = false;
        };
        const openMenu = () => {
            document.getElementById("container").style.right = "0%";
            document.getElementById("menu").style.opacity = "1";
        };
        const closeMenu = () => {
            document.getElementById("container").style.right = "-100%";
            document.getElementById("menu").style.opacity = "0";
        };

        return {
            openMenu,
            search,
            closeMenu,
            resp,
            searchQuery,
            filteredItems,
            toggleSearch,
            selectSuggestion,
        };
    },
};
</script>
