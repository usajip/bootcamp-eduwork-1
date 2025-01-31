@extends('template.layouts')
@section('title', 'Halaman Product')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4>Halo {!! $name !!}</h4>
            @empty($names)
            <p>Selamat Datang</p>
            @endempty
            <table class="table">
                <tr class="bg-primary">
                    <th>Nama</th>
                    <th>Stock</th>
                </tr>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->stock}}</td>
                </tr>
                @endforeach
            </table>
            @foreach($buah as $b)
            <p>{{$b}}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection