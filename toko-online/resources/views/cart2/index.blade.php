<!DOCTYPE html>
@extends('template.layouts')
@section('title', 'Shopping Cart')
@section('content')
    <div class="container mt-5">
        <h1>Shopping Cart</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($carts->count())
        <form action="{{ route('cart.order') }}" method="POST">
            @csrf
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Check</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        {{-- <th>Quantity</th> --}}
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($carts as $key => $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="cart_ids[]" value="{{ $item['id'] }}" class="checkbox">
                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>Rp{{ number_format($item->product->price) }}</td>
                            <td>
                                <!-- Form Edit Quantity -->
                                <form action="{{ route('carts.update', $item->id) }}" method="POST" class="d-inline d-flex">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control d-inline w-auto" min="1">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                            <td>Rp{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            <td>
                                <a href="{{ route('carts.destroy', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Remove</a>
                            </td>
                        </tr>
                        @php $total += $item->product->price * $item->quantity; @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Grand Total</th>
                        <th>Rp{{ number_format($total) }}</th>
                    </tr>
                </tfoot>
            </table>
            <div class="mb-3">
                <label for="name" class="form-label">Nama lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="whatsapp" class="form-label">Nomor Whatsapp</label>
                <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{ old('name') }}" required>
                @error('whatsapp') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat Lengkap</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('name') }}" required>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" id="submitButton" class="btn btn-primary" disabled>Order</button>
        </form>
        <script>
            // Ambil semua checkbox dan tombol
            const checkboxes = document.querySelectorAll('.checkbox');
            const submitButton = document.getElementById('submitButton');
        
            // Fungsi untuk mengecek apakah ada checkbox yang dicentang
            function updateButtonState() {
              const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
              submitButton.disabled = !isChecked;
            }
        
            // Tambahkan event listener untuk setiap checkbox
            checkboxes.forEach(checkbox => {
              checkbox.addEventListener('change', updateButtonState);
            });
          </script>
        @else
            <p>No items in cart.</p>
        @endif
    </div>
@endsection