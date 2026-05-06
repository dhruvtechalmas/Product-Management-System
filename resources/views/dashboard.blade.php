<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @role('admin')
    <h3>Admin Dashboard</h3>
    @endrole

    @role('staff')
    <h3>Staff Dashboard</h3>
    @endrole

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <canvas id="productChart"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx = document.getElementById('productChart');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Total', 'Active', 'Out of Stock'],
                            datasets: [{
                                label: 'Products',
                                data: [
                {{ $totalProducts }},
                {{ $activeProducts }},
                                    {{ $outOfStock }}
                                ],
                                borderWidth: 1
                            }]
                        }
                    });
                </script>
                <style>
                    .dashboard-card {
                        border-radius: 15px;
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

                <div class="row g-4">

                    <!-- Total Products -->
                    <div class="col-md-3">
                        <div class="card dashboard-card bg-primary text-dark p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title btn btn-dark">Total Products</div>
                                    <div class="card-value btn btn-dark">{{ $totalProducts }}</div>
                                </div>
                                <div class="icon-box">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Products -->
                    <div class="col-md-3">
                        <div class="card dashboard-card bg-success text-dark p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">Active Products</div>
                                    <div class="card-value">{{ $activeProducts }}</div>
                                </div>
                                <div class="icon-box">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Out of Stock -->
                    <div class="col-md-3">
                        <div class="card dashboard-card bg-danger text-dark p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">Out of Stock</div>
                                    <div class="card-value">{{ $outOfStock }}</div>
                                </div>
                                <div class="icon-box">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="col-md-3">
                        <div class="card dashboard-card bg-warning text-dark p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">Categories</div>
                                    <div class="card-value">{{ $categoriesCount }}</div>
                                </div>
                                <div class="icon-box">
                                    <i class="fas fa-tags"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



</x-app-layout>