<template>
    <section class="bg-white">
        <div class="px-10 my-24 mx-auto">
            <div>
                <p class="font-medium text-blue-500 text-center">Contact us</p>

                <h1
                    class="mt-2 text-2xl font-semibold text-gray-800 text-center md:text-3xl"
                >
                    Chat to our friendly team
                </h1>

                <p class="mt-3 text-gray-500 text-center">
                    We’d love to hear from you. Please fill out this form or
                    shoot us an email.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-12 mt-10 lg:grid-cols-2">
                <div class="flex flex-col justify-center items-center gap-4">
                    <div
                        class="w-80 max-sm:flex max-sm:flex-col max-sm:items-center"
                    >
                        <span
                            class="inline-block w-10 h-10 text-blue-500 rounded-full bg-blue-100/80 flex justify-center items-center"
                        >
                            <i
                                class="fa-regular flex justify-center items-center w-5 h-5 fa-envelope"
                            ></i>
                        </span>

                        <h2 class="text-base font-medium text-gray-800 mt-4">
                            Email:
                        </h2>
                        <p class="mt-2 text-sm text-gray-500">
                            Our friendly team is here to help.
                        </p>
                        <p class="mt-2 text-sm text-blue-500">
                            houry.k.mohamad@gmail.com
                        </p>
                    </div>

                    <div
                        class="w-80 max-sm:flex max-sm:flex-col max-sm:items-center"
                    >
                        <span
                            class="inline-block w-10 h-10 text-blue-500 rounded-full bg-blue-100/80 flex justify-center items-center"
                        >
                            <i
                                class="fa-solid flex justify-center items-center h-5 w-5 fa-location-dot"
                            ></i>
                        </span>

                        <h2 class="text-base font-medium text-gray-800 mt-4">
                            Home:
                        </h2>
                        <p class="mt-2 text-sm text-gray-500">
                            Come say hello at our home.
                        </p>
                        <p class="mt-2 text-sm text-blue-500">
                            Beirut, Lebanon
                        </p>
                    </div>

                    <div
                        class="w-80 max-sm:flex max-sm:flex-col max-sm:items-center"
                    >
                        <span
                            class="inline-block w-10 h-10 text-blue-500 rounded-full bg-blue-100/80 flex justify-center items-center"
                        >
                            <i
                                class="fa-solid flex justify-center items-center h-5 w-5 fa-phone"
                            ></i>
                        </span>

                        <h2 class="text-base font-medium text-gray-800 mt-4">
                            Phone:
                        </h2>
                        <p class="mt-2 text-sm text-gray-500">
                            Contact us for any inquiries or assistance.
                        </p>
                        <p class="mt-2 text-sm text-blue-500">
                            +961 03-753-401
                        </p>
                    </div>
                </div>

                <div class="p-4 py-6 rounded-lg bg-gray-50 md:p-8">
                    <form
                        id="fs-frm"
                        name="simple-contact-form"
                        accept-charset="utf-8"
                        action="https://formspree.io/f/mjvdzypp"
                        method="post"
                    >
                        <fieldset id="fs-frm-inputs">
                            <div class="-mx-2 md:items-center md:flex">
                                <div class="flex-1 px-2">
                                    <label
                                        class="block mb-2 text-sm text-gray-600"
                                        for="full-name"
                                        >Full Name:</label
                                    >
                                    <input
                                        type="text"
                                        name="name"
                                        id="full-name"
                                        class="block w-full px-5 py-2.5 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40"
                                        placeholder="Please enter your Full Name..."
                                        required="true"
                                    />
                                </div>
                            </div>

                            <div class="mt-4">
                                <label
                                    class="block mb-2 text-sm text-gray-600"
                                    for="email-address"
                                    >Email Address:</label
                                >
                                <input
                                    class="block w-full px-5 py-2.5 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40"
                                    type="email"
                                    name="_replyto"
                                    id="email-address"
                                    placeholder="Enter your Email..."
                                    required="true"
                                />
                            </div>

                            <div class="w-full mt-4">
                                <label
                                    class="block mb-2 text-sm text-gray-600"
                                    for="message"
                                    >Message:</label
                                >
                                <textarea
                                    rows="5"
                                    name="message"
                                    id="message"
                                    class="block w-full h-32 px-5 py-2.5 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg md:h-56 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40"
                                    placeholder="Enter your Message here..."
                                    required="true"
                                ></textarea>
                                <input
                                    type="hidden"
                                    name="_subject"
                                    id="email-subject"
                                    value="Contact Form Submission"
                                />
                            </div>
                            <input
                                value="Submit"
                                type="submit"
                                class="w-full cursor-pointer px-6 py-3 mt-4 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-800 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50"
                            />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
