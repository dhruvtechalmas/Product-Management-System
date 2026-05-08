<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            User Dashboard

        </h2>

    </x-slot>

    <div class="container py-5">

        <div class="row g-4">

            {{-- MY ORDERS --}}

            <div class="col-md-4">

                <a href="{{ route('my.orders') }}"
                   class="text-decoration-none">

                    <div class="card shadow border-0 rounded-4 p-4">

                        <h4>
                            My Orders
                        </h4>

                        <p class="text-muted">

                            Track your orders

                        </p>

                    </div>

                </a>

            </div>

            {{-- PROFILE --}}

            <div class="col-md-4">

                <div class="card shadow border-0 rounded-4 p-4">

                    <h4>
                        My Profile
                    </h4>

                    <p class="text-muted">

                        Manage account details

                    </p>

                </div>

            </div>

            {{-- SHOP --}}

            <div class="col-md-4">

                <a href="{{ url('/') }}"
                   class="text-decoration-none">

                    <div class="card shadow border-0 rounded-4 p-4">

                        <h4>
                            Continue Shopping
                        </h4>

                        <p class="text-muted">

                            Explore products

                        </p>

                    </div>

                </a>

            </div>

        </div>

    </div>

</x-app-layout>