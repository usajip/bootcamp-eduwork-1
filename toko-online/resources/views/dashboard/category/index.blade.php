<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-10">
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
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold">Kategori Produk</h1>
            <button id="open-modal" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Kategori</button>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="table-auto w-full text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nama Kategori</th>
                        <th class="px-4 py-2">Jumlah Produk</th>
                        <th class="px-4 py-2">Total Harga Produk</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $category->id }}</td>
                            <td class="px-4 py-2">{{ $category->name }}</td>
                            <td class="px-4 py-2">{{ $category->product_count }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($category->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    <a href="#!" data-bs-toggle="modal" data-bs-target="#edit{{ $category->id }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                    <a href="#!" data-bs-toggle="modal" data-bs-target="#delete{{ $category->id }}" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</a>
                                    {{-- <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="confirmDelete({{ $category->id }})">Hapus</button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="edit{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit {{ $category->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                                        @method('PUT') @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name" class="col-form-label">Name:</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure want to Delete {{ $category->name }}?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

            @if ($categories->isEmpty())
                <div class="text-center p-5">
                    <p class="text-gray-500">Belum ada kategori produk.</p>
                </div>
            @endif
        </div>

        <div class="mt-5">
            {{ $categories->links() }} <!-- Pagination links -->
        </div>
    </div>
    <!-- Modal -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>
            <form action="{{ route('category.store') }}" method="POST" id="category-form">
                @csrf
                <label for="category-name" class="block font-medium mb-2">Nama Kategori</label>
                <input type="text" id="category-name" name="name" 
                    class="w-full border border-gray-300 p-2 rounded-md mb-4" required>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="close-modal" class="bg-gray-400 text-white px-4 py-2 rounded-md">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
<script>
    const modal = document.getElementById('modal');
    const openModal = document.getElementById('open-modal');
    const closeModal = document.getElementById('close-modal');
    
    openModal.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
</script>
</x-app-layout>
