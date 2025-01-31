@extends('template.layouts')
@section('title', 'Halaman Contoh 2')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div>Page Title {{ $title }}</div>
            <div>Page Title {!! $title !!}</div>
            @php
            $is_logged_in = false;
            @endphp
            @if($is_logged_in)
            <p>Kamu sudah login</p>
            @elseif($is_logged_in == false)
            <p>Kamu belum login</p>
            @endif

            @foreach($users as $user)
            <p>{{ $user }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection