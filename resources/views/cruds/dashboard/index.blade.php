@extends('layouts.auth')

@section('title', 'Dashboard')

@section('content')
<main class="container flex flex-col items-center justify-center py-10">
    <h2 class="uppercase">Dashboard</h2>
    <h4 class="mt-2 uppercase">{{ auth()->user()->role->value }}</h4>
    <a href="{{ route('logout') }}" class="btn btn_primary mt-6 uppercase" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
        Logout
    </a>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
</main>
@endsection
