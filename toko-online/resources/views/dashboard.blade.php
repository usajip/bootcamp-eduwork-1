<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Ringkasan Data</h1>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Kartu Jumlah Produk -->
                        <div class="bg-white p-6 rounded-xl shadow-md">
                            <h2 class="text-xl font-semibold text-gray-700">Jumlah Produk</h2>
                            <p class="text-4xl font-bold text-blue-500 mt-2">1,234</p>
                        </div>
                        
                        <!-- Kartu Jumlah Kategori -->
                        <div class="bg-white p-6 rounded-xl shadow-md">
                            <h2 class="text-xl font-semibold text-gray-700">Jumlah Kategori</h2>
                            <p class="text-4xl font-bold text-green-500 mt-2">56</p>
                        </div>
                        
                        <!-- Kartu Jumlah Klik Produk -->
                        <div class="bg-white p-6 rounded-xl shadow-md">
                            <h2 class="text-xl font-semibold text-gray-700">Jumlah Klik Produk</h2>
                            <p class="text-4xl font-bold text-red-500 mt-2">12,345</p>
                        </div>
                    </div>
                    <!-- Chart Penjualan -->
                    <div class="bg-white p-6 rounded-xl shadow-md mt-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Data Penjualan</h2>
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
                datasets: [{
                    label: 'Penjualan',
                    data: [1200, 200, 3000, 5000, 2000, 3000],
                    backgroundColor: 'rgba(255, 99, 71, 0.8)',
                    borderColor: 'rgba(255, 99, 71, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
