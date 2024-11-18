@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-2xl font-medium text-gray-900">Account Overview</h1>
            <p class="text-sm text-green-600 mt-1">Welcome back, {{ Auth::user()->name }}</p>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl border border-green-100 overflow-hidden">
            <!-- Profile Section -->
            <div class="p-6 space-y-6">
                <!-- Account Details -->
                <div class="space-y-4">
                    <!-- Name -->
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <div>
                            <p class="text-sm text-gray-500">Name</p>
                            <p class="text-base text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="text-green-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-base text-gray-900">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="text-green-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Join Date -->
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <div>
                            <p class="text-sm text-gray-500">Member Since</p>
                            <p class="text-base text-gray-900">{{ Auth::user()->created_at->format('F d, Y') }}</p>
                        </div>
                        <div class="text-green-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <div class="flex items-center mt-1">
                                <span class="inline-flex items-center text-green-700">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293 a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Verified
                                </span>
                            </div>
                        </div>
                        <div class="text-green-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="pt-6 mt-6 border-t border-gray-100">
                    <form method="POST" action="{{ route('profile.destroy') }}" id="delete-account-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="deleteAccount()">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteAccount() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-account-form').submit();
        }
    });
}
</script>
@endsection