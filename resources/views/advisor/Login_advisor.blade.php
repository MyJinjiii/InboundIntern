@extends('layouts/navigation')
@section('title')
Login
@endsection
@section('header')

<br>
<h1 class="admissionstatus">LOGIN</h1>
@endsection
@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="bg-whaite p-8 rounded-lg shadow-lg">
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block font-medium">Email</label>
                <input type="email" id="email" name="email" class="border rounded px-4 py-2 w-full" required autofocus placeholder="Your email">
            </div>
            <div class="mb-4">
                <label for="password" class="block font-medium">Password</label>
                <input type="password" id="password" name="password" class="border rounded px-4 py-2 w-full" required placeholder="password">
            </div>
            <div class="mb-4">
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Don't have an account? Register</a>
            </div>
            <button type="submit" class="change-btn">Login</button>
        </form>
    </div>
</div>
@endsection
