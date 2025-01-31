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
            <table class="table table-striped">
                <thead>
                    <tr>
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
        @else
            <p>No items in cart.</p>
        @endif
    </div>
@endsection