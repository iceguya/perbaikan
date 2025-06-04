@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Dashboard Teknisi</h1>
    <p>Selamat datang, {{ auth()->user()->name }}! Kamu adalah Teknisi.</p>
</div>
@endsection
