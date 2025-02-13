<x-app-layout>
    <div class="container mx-auto py-10">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Image Section -->
                <div>
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full rounded-lg">
                </div>
                <!-- Details Section -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
                    <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                    <div class="mt-4">
                        <span class="text-xl font-bold text-gray-800">Harga: </span>
                        <span class="text-xl font-bold text-green-600">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-lg font-medium text-gray-800">Stok: </span>
                        <span class="text-lg {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? $product->stock . ' tersedia' : 'Stok habis' }}
                        </span>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('carts.add-to-cart', $product->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Tambahkan ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>