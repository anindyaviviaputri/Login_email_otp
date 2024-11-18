@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white p-5 rounded-lg shadow-md">
        <h2 class="text-lg font-bold mb-4 text-green-600">Verify OTP</h2>
        <form method="POST" action="{{ route('verify.otp') }}">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            <div class="mb-4">
                <label for="otp" class="block text-gray-700 text-sm font-bold mb-2">Enter OTP Code</label>
                <input type="text" id="otp" name="otp" class="shadow appearance-none border border-green-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-green-500" placeholder="Enter your OTP">
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-200">Verify</button>
        </form>
    </div>
@endsection