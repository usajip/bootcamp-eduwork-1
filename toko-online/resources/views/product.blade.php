@extends('template.layouts')
@section('title', 'Halaman Product')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Ini Adalah halaman product</h1>
            <x-alert-component type="danger">
                Error
            </x-alert-component>
            <x-alert-component type="success">Sukses</x-alert-component>
            <x-alert-component type="info">Info</x-alert-component>
            <x-alert-component type="warning">Warning</x-alert-component>
        </div>
    </div>
</div>
    
@endsection