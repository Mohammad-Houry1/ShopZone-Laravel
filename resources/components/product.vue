<template>
    <div id="NoProd" class="w-full h-full fixed bg-white z-[1000] hidden my-16">
        <div class="flex flex-col justify-center items-center">
            <img src="../images/product.png" alt="no prod" class="" />
            <h1 class="text-4xl text-gray-800 font-bold my-4">
                No Product Found!
            </h1>
            <span class="text-lg font-semibold text-gray-400"
                >Your filters didn't match any products.</span
            >
            <span class="text-lg font-semibold text-gray-400"
                >Please try again.</span
            >
            <button
                id="button"
                class="p-4 rounded-lg bg-gray-900 border relative z-[10000] text-white px-2 focus:outline-none focus:ring-2 focus:ring-gray-500"
                @click="allProd()"
            >
                Try Again
            </button>
        </div>
    </div>
    <div class="my-4" id="All">
        <!-- Mobile version -->
        <TransitionRoot as="template" :show="mobileFiltersOpen">
            <Dialog
                as="div"
                class="relative z-40 lg:hidden"
                @close="mobileFiltersOpen = false"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild
                        as="template"
                        enter="transition ease-in-out duration-300 transform"
                        enter-from="translate-x-full"
                        enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform"
                        leave-from="translate-x-0"
                        leave-to="translate-x-full"
                    >
                        <DialogPanel
                            class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl mt-20"
                        >
                            <div class="flex items-center justify-between px-4">
                                <h2 class="text-lg font-medium text-gray-900">
                                    Filters
                                </h2>
                                <button
                                    type="button"
                                    class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                                    @click="mobileFiltersOpen = false"
                                >
                                    <span class="sr-only">Close menu</span>
                                    <XMarkIcon
                                        class="h-6 w-6"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>

                            <!-- Filters -->
                            <div class="mt-4 border-t border-gray-200">
                                <h3 class="sr-only">Categories</h3>
                                <ul
                                    role="list"
                                    class="px-2 py-3 font-medium text-gray-900"
                                >
                                    <li
                                        v-for="category in subCategories"
                                        :key="category.name"
                                    >
                                        <button
                                            @click="
                                                category.funct(category.value)
                                            "
                                            class="block px-2 py-3 hover:text-gray-800"
                                        >
                                            {{ category.name }}
                                        </button>
                                    </li>
                                </ul>

                                <Disclosure
                                    as="div"
                                    v-for="section in filters"
                                    :key="section.id"
                                    class="border-t border-gray-200 px-4 py-6 mb-4"
                                    v-slot="{ open }"
                                >
                                    <h3 class="-mx-2 -my-3 flow-root">
                                        <DisclosureButton
                                            class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                        >
                                            <span
                                                class="font-medium text-gray-900"
                                                >{{ section.name }}</span
                                            >
                                            <span
                                                class="ml-6 flex items-center"
                                            >
                                                <PlusIcon
                                                    v-if="!open"
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                                <MinusIcon
                                                    v-else
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-6">
                                            <div
                                                v-for="(
                                                    option, optionIdx
                                                ) in section.options"
                                                :key="option.value"
                                                class="flex items-center"
                                            >
                                                <input
                                                    :id="`filter-mobile-${section.id}-${optionIdx}`"
                                                    :name="`${section.id}[]`"
                                                    :value="option.value"
                                                    type="radio"
                                                    :checked="option.checked"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    @click="
                                                        option.funct(
                                                            option.value
                                                        )
                                                    "
                                                />
                                                <label
                                                    :for="`filter-mobile-${section.id}-${optionIdx}`"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500"
                                                    >{{ option.label }}</label
                                                >
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24"
            >
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                    All Products
                </h1>

                <!-- Sort dropdown menu -->
                <div class="flex items-center">
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton
                                class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                            >
                                Sort
                                <ChevronDownIcon
                                    class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                    aria-hidden="true"
                                />
                            </MenuButton>
                        </div>
                        <MenuItems
                            class="absolute right-0 z-[999] mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                        >
                            <div class="py-1">
                                <MenuItem
                                    v-for="(option, index) in sortOptions"
                                    :key="option.name"
                                    v-slot="{ active }"
                                >
                                    <button
                                        :class="[
                                            option.current
                                                ? 'font-medium text-gray-900'
                                                : 'text-gray-500',
                                            active ? 'bg-gray-100' : '',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        @click="option.funct(index)"
                                    >
                                        {{ option.name }}
                                    </button>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </Menu>

                    <!-- Mobile filters button -->
                    <button
                        type="button"
                        @click="ProdDisplay()"
                        class="-m-2 ml-5 p-2 text-gray-400 hover:text-gray-500 sm:ml-7"
                    >
                        <span class="sr-only">View grid</span>
                        <Squares2X2Icon class="h-5 w-5" aria-hidden="true" />
                    </button>
                    <button
                        type="button"
                        class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
                        @click="mobileFiltersOpen = true"
                    >
                        <span class="sr-only">Filters</span>
                        <FunnelIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </div>
            </div>

            <section aria-labelledby="products-heading" class="pb-24 pt-6">
                <h2 id="products-heading" class="sr-only">Products</h2>

                <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                    <!-- Filter options -->
                    <div class="hidden lg:block">
                        <h3 class="sr-only">Categories</h3>
                        <ul
                            role="list"
                            class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900"
                        >
                            <li
                                v-for="category in subCategories"
                                :key="category.name"
                            >
                                <button
                                    class="text-lg"
                                    @click="category.funct(category.value)"
                                >
                                    {{ category.name }}
                                </button>
                            </li>
                        </ul>

                        <!-- Filter sections -->
                        <Disclosure
                            as="div"
                            v-for="section in filters"
                            :key="section.id"
                            class="border-b border-gray-200 py-6"
                            v-slot="{ open }"
                        >
                            <h3 class="-my-3 flow-root">
                                <DisclosureButton
                                    class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                >
                                    <span
                                        class="font-medium text-gray-900 text-lg"
                                        >{{ section.name }}</span
                                    >
                                    <span class="ml-6 flex items-center">
                                        <PlusIcon
                                            v-if="!open"
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                        <MinusIcon
                                            v-else
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                    </span>
                                </DisclosureButton>
                            </h3>
                            <DisclosurePanel class="pt-6">
                                <div class="space-y-4">
                                    <div
                                        v-for="(
                                            option, optionIdx
                                        ) in section.options"
                                        :key="option.value"
                                        class="flex items-center"
                                    >
                                        <input
                                            :id="`filter-${section.id}-${optionIdx}`"
                                            :name="`${section.id}[]`"
                                            :value="option.value"
                                            :checked="option.checked"
                                            type="radio"
                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                            @click="option.funct(option.value)"
                                        />
                                        <label
                                            :for="`filter-${section.id}-${optionIdx}`"
                                            class="ml-3 text-sm text-gray-600"
                                        >
                                            {{ option.label }}
                                        </label>
                                    </div>
                                </div>
                            </DisclosurePanel>
                        </Disclosure>
                    </div>

                    <!-- Products -->
                    <div class="lg:col-span-3">
                        <div
                            id="product-grid"
                            class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8"
                        >
                            <div
                                v-for="product in resp"
                                :key="product.id"
                                id="products"
                                class="shadow-md relative max-sm:flex-col overflow-hidden border rounded-lg flex flex-col transform transition-transform duration-300 hover:scale-105"
                            >
                                <div class="flex-shrink-0 bg-gray-200 p-4">
                                    <img
                                        :src="product.Img_src"
                                        :alt="product.Img_alts"
                                        class="w-[300px] h-[300px] object-contain mx-auto border-b"
                                    />
                                </div>
                                <div
                                    class="p-4 flex flex-col justify-between flex-grow"
                                >
                                    <div
                                        class="flex flex-col justify-start flex-grow"
                                    >
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
                                            <span
                                                class="font-bold text-gray-900"
                                                >${{ product.Price }}</span
                                            >
                                            <div
                                                class="flex items-center space-x-2"
                                            >
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
                                                        addToWishlist(
                                                            product.Product_name
                                                        )
                                                    "
                                                    ref="likeBtn"
                                                >
                                                    <i
                                                        class="fa-regular fa-heart"
                                                    ></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>
<script setup>
import { toggleLikeBtn } from "../js/App.vue";
import { ref, onMounted } from "vue";
import axios from "axios";
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import {
    ChevronDownIcon,
    FunnelIcon,
    Squares2X2Icon,
    MinusIcon,
    PlusIcon,
} from "@heroicons/vue/24/outline";
const defaultProd = ref([]);
const sortByBrandAToZ = (index) => {
    resp.value.sort((a, b) => a.Brand.localeCompare(b.Brand));
    setActiveOption(index);
};

const sortByBrandZToA = (index) => {
    resp.value.sort((a, b) => b.Brand.localeCompare(a.Brand));
    setActiveOption(index);
};
const sortByLowPrice = (index) => {
    resp.value.sort((a, b) => parseFloat(a.Price) - parseFloat(b.Price));
    setActiveOption(index);
};

const sortByHighPrice = (index) => {
    resp.value.sort((a, b) => parseFloat(b.Price) - parseFloat(a.Price));
    setActiveOption(index);
};
const sortByRandomPrice = (index) => {
    resp.value.sort(() => Math.random() - 0.5);
    setActiveOption(index);
};

const filteringProd = (index) => {
    resp.value = defaultProd.value;
    resp.value = resp.value.filter((item) => item.SubCategory === index);
};

const allProd = () => {
    resp.value = defaultProd.value;
};
const sortOptions = [
    {
        name: "Price: Random",
        current: true,
        funct: sortByRandomPrice,
    },
    {
        name: "Brand: A to Z",
        current: false,
        funct: sortByBrandAToZ,
    },
    {
        name: "Brand: Z to A",
        current: false,
        funct: sortByBrandZToA,
    },
    {
        name: "Price: Low to High",
        current: false,
        funct: sortByLowPrice,
    },
    {
        name: "Price: High to Low",
        current: false,
        funct: sortByHighPrice,
    },
];
const setActiveOption = (index) => {
    sortOptions.forEach((option, i) => {
        option.current = i === index;
    });
};

const subCategories = [
    { name: "All", value: "All", funct: allProd },
    { name: "Clothing", value: "Clothing", funct: filteringProd },
    { name: "Footwear", value: "Footwear", funct: filteringProd },
    {
        name: "Computer parts",
        value: "Computer parts",
        funct: filteringProd,
    },
    {
        name: "Computers and Laptops",
        value: "Computers and Laptops",
        funct: filteringProd,
    },
    {
        name: "Accessories",
        value: "Accessories",
        funct: filteringProd,
    },
];
//ken bade sewe 2 parameter 1 la te5oud el value w el tenye to filter between masalan el rating aw female aw male aw masalan brand
// const filterByFilters = (index, val) => {
//     resp.value = defaultProd.value;
//     resp.value = resp.value.filter((item) => item.Category === index);
// };
let newProdList;
const filterByCat = (index) => {
    resp.value = defaultProd.value;
    resp.value = resp.value.filter((item) => item.Category === index);
    newProdList = resp.value;
};
const filterByRating = (index) => {
    resp.value = defaultProd.value;
    resp.value = resp.value.filter((item) => item.rating === index);
    if (resp.value.length == 0) {
        $("#NoProd")[0].classList.add("main");
        console.log($("#All")[0]);
    }
};
const filterByGender = (index) => {
    resp.value = defaultProd.value;
    resp.value = resp.value.filter((item) => item.Gender === index);
};
const filters = [
    {
        id: "category",
        name: "Category",
        options: [
            {
                value: "All",
                label: "All",
                checked: true,
                funct: allProd,
            },
            {
                value: "Electronics",
                label: "Electronics",
                checked: false,
                funct: filterByCat,
            },
            {
                value: "Men's Clothing",
                label: "Men's Clothing",
                checked: false,
                funct: filterByCat,
            },
            {
                value: "Women's Clothing",
                label: "Women's Clothing",
                checked: false,
                funct: filterByCat,
            },
        ],
    },
    {
        id: "Customer Reviews",
        name: "Customer Reviews",
        options: [
            {
                value: "5",
                label: "5 Stars",
                checked: false,
                funct: filterByRating,
            },
            {
                value: "4",
                label: "4 Stars",
                checked: false,
                funct: filterByRating,
            },
            {
                value: "3",
                label: "3 Stars",
                checked: false,
                funct: filterByRating,
            },
            {
                value: "2",
                label: "2 Stars",
                checked: false,
                funct: filterByRating,
            },
            {
                value: "1",
                label: "1 Star",
                checked: false,
                funct: filterByRating,
            },
        ],
    },
    {
        id: "Genders",
        name: "Genders",
        options: [
            {
                value: "All",
                label: "All",
                checked: true,
                funct: allProd,
            },
            {
                value: "Male",
                label: "Male",
                checked: false,
                funct: filterByGender,
            },
            {
                value: "Female",
                label: "Female",
                checked: false,
                funct: filterByGender,
            },
        ],
    },
];

const mobileFiltersOpen = ref(false);

const wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
const resp = ref([]);

const fetchData = async () => {
    try {
        const response = await axios.get("/api/posts");
        resp.value = response.data;
        defaultProd.value = response.data;
        console.log(resp.value);
    } catch (error) {
        console.error(error);
    }
};

const addToWishlist = (productName) => {
    toggleLikeBtn(wishlist, productName);
};

onMounted(() => {
    fetchData();
});

const ProdDisplay = () => {
    const productGrid = document.querySelectorAll("#product-grid ");
    const products = document.querySelectorAll("#products");

    productGrid.forEach((element) => {
        element.classList.toggle("flexi");
    });

    products.forEach((element) => {
        element.classList.toggle("flax");
    });
};
</script>
