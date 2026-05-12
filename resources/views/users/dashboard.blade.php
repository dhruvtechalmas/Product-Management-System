<x-app-layout>

    <x-slot name="header">

        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            My Dashboard
        </h2>

    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- TOP WELCOME CARD --}}

            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-3xl shadow-xl overflow-hidden mb-8">

                <div class="p-8 md:flex items-center justify-between">

                    <div>

                        <h1 class="text-4xl font-extrabold text-dark mb-3">

                            Welcome,
                            {{ auth()->user()->name }}

                        </h1>

                        <p class="text-indigo-100 text-lg">

                            Manage your orders, profile and shopping activity.

                        </p>

                    </div>


                </div>

            </div>

            {{-- DASHBOARD CARDS --}}

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">

                {{-- ORDERS --}}

                <a href="{{ route('my.orders') }}"
                   class="bg-white rounded-3xl shadow-md hover:shadow-2xl transition duration-300 p-6 block">

                    <div class="flex items-center justify-between mb-5">

                        <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-8 w-8 text-blue-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"/>

                            </svg>

                        </div>

                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-2">

                        My Orders

                    </h3>

                    <p class="text-gray-500">

                        View and track all your recent orders.

                    </p>

                </a>

                {{-- PROFILE --}}

                <a href="{{ route('profile.show') }}"
                   class="bg-white rounded-3xl shadow-md hover:shadow-2xl transition duration-300 p-6 block">

                    <div class="flex items-center justify-between mb-5">

                        <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-8 w-8 text-green-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>

                            </svg>

                        </div>

                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-2">

                        My Profile

                    </h3>

                    <p class="text-gray-500">

                        Manage your account information and settings.

                    </p>

                </a>

                {{-- SHOPPING --}}

                <a href="{{ url('/') }}"
                   class="bg-white rounded-3xl shadow-md hover:shadow-2xl transition duration-300 p-6 block">

                    <div class="flex items-center justify-between mb-5">

                        <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-8 w-8 text-yellow-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>

                            </svg>

                        </div>

                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-2">

                        Continue Shopping

                    </h3>

                    <p class="text-gray-500">

                        Explore new arrivals and trending products.

                    </p>

                </a>

            </div>

            {{-- EXTRA INFO --}}

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

                <div class="bg-white rounded-3xl shadow-md p-6 text-center">

                    <h4 class="text-3xl font-bold text-indigo-600">

                        {{ auth()->user()->created_at->format('d M Y') }}

                    </h4>

                    <p class="text-gray-500 mt-2">

                        Member Since

                    </p>

                </div>

                <div class="bg-white rounded-3xl shadow-md p-6 text-center">

                    <h4 class="text-3xl font-bold text-green-600">

                        Verified

                    </h4>

                    <p class="text-gray-500 mt-2">

                        Account Status

                    </p>

                </div>

                <div class="bg-white rounded-3xl shadow-md p-6 text-center">

                    <h4 class="text-3xl font-bold text-purple-600">

                        Customer

                    </h4>

                    <p class="text-gray-500 mt-2">

                        User Role

                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>