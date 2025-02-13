<x-app-layout>
    <div class="bg-blue-500 text-white py-20">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row items-center p-10">
                <div class="lg:w-1/2 mb-6 lg:mb-0">
                    <h1 class="text-4xl font-bold mb-4">Selamat Datang di Toko Kami</h1>
                    <p class="text-lg mb-6">Temukan berbagai produk terbaik dengan harga terjangkau</p>
                    <a href="#products" class="bg-white text-blue-500 px-6 py-3 rounded font-semibold hover:bg-gray-100">Jelajahi Produk</a>
                </div>
                <div class="lg:w-1/2 flex justify-center">
                    <img src="{{ asset('images/hero.webp') }}" alt="Hero Illustration" class="w-auto max-h-80 rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('search.product') }}" method="GET">
        <div class="mb-3">
            <input type="text" class="form-control" name="search" value="{{ old('search') }}" required>
        </div>
    </form>
    @foreach($categories as $category)
    <a href="{{ route('product.category', $category->id)}}" class="btn">{{$category->name}} </a>
    @endforeach
    <div class="container mx-auto py-10" id="products">
        <h1 class="text-3xl font-bold text-center mb-10">Daftar Produk</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($products as $product)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-lg font-bold mb-2">{{ $product->name }}</h2>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                        <p class="text-xl font-semibold text-blue-500 mb-4">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        {{-- <a href="{{ route('cart.add-to-cart', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Tambahkan ke Keranjang</a> --}}
                        {{-- <a href="{{ route('carts.add-to-cart', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Tambahkan ke Keranjang</a> --}}
                        <a href="{{ route('product.show', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Lihat Detail</a>
                    </div>
                </div>
            @empty
            @endforelse
        </div>

        @if($products->isEmpty())
            <div class="text-center mt-10">
                <p class="text-gray-500">Belum ada produk yang tersedia.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
            @foreach ($recommendation as $product)
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-lg font-bold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                    <p class="text-xl font-semibold text-blue-500 mb-4">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    {{-- <a href="{{ route('cart.add-to-cart', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Tambahkan ke Keranjang</a> --}}
                    <a href="{{ route('carts.add-to-cart', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Tambahkan ke Keranjang</a>
                </div>
            </div>
            @endforeach
            </div>
        @endif

        <div class="mt-10">
            {{ $products->links() }} <!-- Pagination links -->
        </div>
    </div>
    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-6 mt-10">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Toko Kami. Semua Hak Dilindungi.</p>
        </div>
    </footer>
</x-app-layout>
