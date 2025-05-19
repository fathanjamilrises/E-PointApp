@extends('auth.layouts')

@section('container')
<div class="flex h-screen w-screen bg-gray-50">
    <!-- Left Panel -->
    <div class="hidden md:flex w-1/2 bg-blue-700 items-center justify-center text-white p-10">
        <div class="text-center max-w-md">
            <h2 class="text-4xl font-bold mb-4">Welcome Back</h2>
            <p class="text-lg">Login to access your dashboard</p>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-white">
        <div class="w-full max-w-md p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Sign in</h1>
                <p class="text-sm text-gray-500">Please enter your credentials</p>
            </div>

            <form action="{{ route('authenticate') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium mb-2">Email address</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" required
                            value="{{ old('email') }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="you@example.com">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter your password">
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        Login
                    </button>
                </div>
            </form>

            <!-- Optional register link -->
            {{-- <div class="mt-6 text-sm text-center">
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Don’t have an account? Register</a>
            </div> --}}
        </div>
    </div>
</div>
@endsection
