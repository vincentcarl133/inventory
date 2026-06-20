<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Inventory Analytics
        </h2>
    </x-slot>
    <br>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
<div class="grid grid-cols-2 gap-6 mb-6">

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <p class="text-sm text-gray-500">Total Products</p>
        <h3 class="text-3xl font-bold mt-2">{{ number_format($totalProducts) }}</h3>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <p class="text-sm text-gray-500">Total Stocks</p>
        <h3 class="text-3xl font-bold mt-2">{{ number_format($totalStocks) }}</h3>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <p class="text-sm text-gray-500">Total Orders</p>
        <h3 class="text-3xl font-bold mt-2">{{ number_format($totalOrders) }}</h3>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <p class="text-sm text-gray-500">Total Revenue</p>
        <h3 class="text-3xl font-bold mt-2">
            ₱{{ number_format($totalRevenue, 2) }}
        </h3>
    </div>

</div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                <div class="xl:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-semibold text-lg">
                            Monthly Orders Trend
                        </h4>
                    </div>

                    <div id="ordersChart"></div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h4 class="font-semibold text-lg mb-4">
                        Quick Summary
                    </h4>

                    <div class="space-y-4">

                        <div class="flex justify-between">
                            <span class="text-gray-500">Products</span>
                            <strong>{{ $totalProducts }}</strong>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Stocks</span>
                            <strong>{{ number_format($totalStocks) }}</strong>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Orders</span>
                            <strong>{{ $totalOrders }}</strong>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Revenue</span>
                            <strong>₱{{ number_format($totalRevenue, 2) }}</strong>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        const monthlyOrders = @json($monthlyOrders);

        const labels = monthlyOrders.map(item => {
            const months = [
                '',
                'Jan', 'Feb', 'Mar', 'Apr',
                'May', 'Jun', 'Jul', 'Aug',
                'Sep', 'Oct', 'Nov', 'Dec'
            ];

            return months[item.month];
        });

        const values = monthlyOrders.map(item => item.total);

        const options = {
            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Orders',
                data: values
            }],
            xaxis: {
                categories: labels
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            dataLabels: {
                enabled: false
            },
            grid: {
                borderColor: '#f1f5f9'
            },
            legend: {
                show: false
            }
        };

        new ApexCharts(
            document.querySelector("#ordersChart"),
            options
        ).render();
    </script>

</x-app-layout>