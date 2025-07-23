@extends('layouts/navigation')
@section('title')
    Register
@endsection
@section('header')
    <br>
    <h1 class="admissionstatus">Register</h1>
@endsection
@section('content')
    <br><br><br><br>
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block font-medium">Title</label>
                    <select name="title" id="title" class="border rounded px-4 py-2 w-full" required>
                        <option value="" disabled selected> </option>
                        <option value="Ms.">Ms.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Mr.">Mr.</option>
                    </select>
                    @error('title')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="name" class="block font-medium">Name <span class="text-gray-500">(e.g., John, max 50
                            characters)</span></label>
                    <input type="text" id="name" name="name" class="border rounded px-4 py-2 w-full"
                        maxlength="50" required autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="surname" class="block font-medium">Surname <span class="text-gray-500">(e.g., Doe, max 50
                            characters)</span></label>
                    <input type="text" id="surname" name="surname" class="border rounded px-4 py-2 w-full"
                        maxlength="50" required>
                    @error('surname')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block font-medium">Email <span class="text-gray-500">(e.g.,
                            john.doe@example.com)</span></label>
                    <input type="email" id="email" name="email" class="border rounded px-4 py-2 w-full" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block font-medium">Password <span class="text-gray-500">(min 8
                            characters)</span></label>
                    <input type="password" id="password" name="password" class="border rounded px-4 py-2 w-full"
                        minlength="8" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium">Re-enter password <span
                            class="text-gray-500">(min 8 characters)</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="border rounded px-4 py-2 w-full" minlength="8" required>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Already have an account?</a>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="change-btn">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
