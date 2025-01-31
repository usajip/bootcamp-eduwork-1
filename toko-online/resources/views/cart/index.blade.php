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

        @if(count($cart) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $key => $item)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>Rp{{ number_format($item['price']) }}</td>
                            <td>
                                <!-- Form Edit Quantity -->
                                <form action="{{ route('cart.update') }}" method="POST" class="d-inline d-flex">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="form-control d-inline w-auto" min="1">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                            <td>Rp{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $item['id']) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Remove</a>
                            </td>
                        </tr>
                        @php $total += $item['price'] * $item['quantity']; @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Grand Total</th>
                        <th>Rp{{ number_format($total) }}</th>
                    </tr>
                </tfoot>
            </table>
        @else
            <p>No items in cart.</p>
        @endif
    </div>
@endsection