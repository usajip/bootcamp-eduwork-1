<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-10">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold">Produk</h1>
            <a href="{{ route('product.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Produk</a>
        </div>

        <x-alert-component type="success"/>
        <x-alert-component type="error"/>
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-400 rounded-lg">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-scroll">
            <table class="table-auto w-full text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Gambar</th>
                        <th class="px-4 py-2">Stok</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $product->id }}</td>
                            <td class="px-4 py-2">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ Str::limit($product->description, 10) }}</td>
                            <td class="px-4 py-2">
                                <img src="{{ Storage::disk('images')->url($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="px-4 py-2">{{ $product->stock }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $product->category->name }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    <a href="{{ route('product.edit', $product->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                    <a href="#!" data-bs-toggle="modal" data-bs-target="#delete{{ $product->id }}" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</a>
                                </div>
                            </td>
                            <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure want to Delete {{ $product->name }}?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($products->isEmpty())
                <div class="text-center p-5">
                    <p class="text-gray-500">Belum ada produk.</p>
                </div>
            @endif
        </div>

        <div class="mt-5">
            {{ $products->links() }} <!-- Pagination links -->
        </div>
    </div>
</x-app-layout>
