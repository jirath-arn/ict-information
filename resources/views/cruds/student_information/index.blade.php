@extends('layouts.auth')

@section('title', 'Student Information')

@section('content')
<main class="container flex items-center justify-center py-10">
    <a href="{{ route('logout') }}" class="btn btn_primary uppercase" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
        Logout
    </a>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
</main>
@endsection
