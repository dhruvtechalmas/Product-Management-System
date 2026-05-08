<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{ __('Dashboard') }}

        </h2>

    </x-slot>

    @role('admin')

    <h3 class="mb-4 fw-bold">
        Admin Dashboard
    </h3>

    @endrole

    @role('staff')

    <h3 class="mb-4 fw-bold">
        Staff Dashboard
    </h3>

    @endrole

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                {{-- CHART --}}

                <canvas id="productChart" height="100"></canvas>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>

                    const ctx = document.getElementById('productChart');

                    new Chart(ctx, {

                        type: 'bar',

                        data: {

                            labels: [

                                'Products',

                                'Active',

                                'Out Of Stock',

                                'Orders',

                                'Users'

                            ],

                            datasets: [{

                                label: 'Ecommerce Analytics',

                                data: [

                                    {{ $totalProducts }},

                                    {{ $activeProducts }},

                                    {{ $outOfStock }},

                                    {{ $totalOrders }},

                                    {{ $totalUsers }}

                                ],

                                borderWidth: 1

                            }]

                        }

                    });

                </script>

                {{-- STYLE --}}

                <style>
                    .dashboard-card {

                        border-radius: 20px;

                        transition: 0.3s;

                        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);

                    }

                    .dashboard-card:hover {

                        transform: translateY(-5px);

                        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);

                    }

                    .icon-box {

                        font-size: 30px;

                        opacity: 0.8;

                    }

                    .card-title {

                        font-size: 16px;

                        margin-bottom: 5px;

                    }

                    .card-value {

                        font-size: 28px;

                        font-weight: bold;

                    }
                </style>

                {{-- CARDS --}}

                <div class="row g-4 mt-4">

                    {{-- TOTAL PRODUCTS --}}

                    <div class="col-md-3">

                        <div class="card dashboard-card bg-primary text-dark p-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-title">
                                        Total Products
                                    </div>

                                    <div class="card-value">
                                        {{ $totalProducts }}
                                    </div>

                                </div>

                                <div class="icon-box">

                                    <i class="fas fa-box"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ACTIVE PRODUCTS --}}

                    <div class="col-md-3">

                        <div class="card dashboard-card bg-success text-dark p-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-title">
                                        Active Products
                                    </div>

                                    <div class="card-value">
                                        {{ $activeProducts }}
                                    </div>

                                </div>

                                <div class="icon-box">

                                    <i class="fas fa-check-circle"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- OUT OF STOCK --}}

                    <div class="col-md-3">

                        <div class="card dashboard-card bg-danger text-dark p-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-title">
                                        Out Of Stock
                                    </div>

                                    <div class="card-value">
                                        {{ $outOfStock }}
                                    </div>

                                </div>

                                <div class="icon-box">

                                    <i class="fas fa-times-circle"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- CATEGORIES --}}

                    <div class="col-md-3">

                        <div class="card dashboard-card bg-warning text-dark p-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-title">
                                        Categories
                                    </div>

                                    <div class="card-value">
                                        {{ $categoriesCount }}
                                    </div>

                                </div>

                                <div class="icon-box">

                                    <i class="fas fa-tags"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- TOTAL ORDERS --}}

                    <div class="col-md-3">

                        <div class="card dashboard-card bg-info text-dark p-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-title">
                                        Total Orders
                                    </div>

                                    <div class="card-value">
                                        {{ $totalOrders }}
                                    </div>

                                </div>

                                <div class="icon-box">

                                    <i class="fas fa-shopping-cart"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- TOTAL USERS --}}

                    <div class="col-md-3">

                        <div class="card dashboard-card bg-secondary text-dark p-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-title">
                                        Total Users
                                    </div>

                                    <div class="card-value">
                                        {{ $totalUsers }}
                                    </div>

                                </div>

                                <div class="icon-box">

                                    <i class="fas fa-users"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- REVENUE --}}

                    <div class="col-md-3">

                        <div class="card dashboard-card bg-dark text-dark p-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-title">
                                        Revenue
                                    </div>

                                    <div class="card-value">
                                        ₹{{ number_format($totalRevenue, 2) }}
                                    </div>

                                </div>

                                <div class="icon-box">

                                    <i class="fas fa-money-bill-wave"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- LOW STOCK --}}

                <div class="card mt-5 shadow border-0 rounded-4">

                    <div class="card-header bg-danger text-dark">

                        <h4 class="mb-0">
                            Low Stock Products
                        </h4>

                    </div>

                    <div class="card-body">

                        <table class="table">

                            <thead>

                                <tr>

                                    <th>Product</th>

                                    <th>Stock</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($lowStockProducts as $product)

                                    <tr>

                                        <td>
                                            {{ $product->name }}
                                        </td>

                                        <td>

                                            <span class="badge bg-danger">

                                                {{ $product->stock }}

                                            </span>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="2">

                                            No Low Stock Products

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- LATEST ORDERS --}}

                <div class="card mt-5 shadow border-0 rounded-4">

                    <div class="card-header bg-dark text-dark">

                        <h4 class="mb-0">
                            Latest Orders
                        </h4>

                    </div>

                    <div class="card-body">

                        <table class="table">

                            <thead>

                                <tr>

                                    <th>Order ID</th>

                                    <th>User</th>

                                    <th>Amount</th>

                                    <th>Status</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($latestOrders as $order)

                                    <tr>

                                        <td>
                                            #{{ $order->id }}
                                        </td>

                                        <td>
                                            {{ $order->user->name ?? 'User' }}
                                        </td>

                                        <td>
                                            ₹{{ $order->amount }}
                                        </td>

                                        <td>

                                            @if($order->payment_status == 'paid')

                                                <span class="badge bg-success">
                                                    Paid
                                                </span>

                                            @else

                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>