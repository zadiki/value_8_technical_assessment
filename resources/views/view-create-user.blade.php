@extends('layouts.app')

@section('content')
<div class="">
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Create New User
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Register a new member for your branch or store management team.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('createUser') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="mt-1 block w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 @error('name') border-red-500 @enderror"
                                placeholder="John Doe">
                            @error('name') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="mt-1 block w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 @error('email') border-red-500 @enderror"
                                placeholder="john@example.com">
                            @error('email') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-semibold text-gray-700">System Role</label>
                            <select name="role" id="role"
                                class="mt-1 block w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                                <option value="{{ \App\Models\User::ROLE_STORE_MANAGER }}">Store Manager</option>
                                <option value="{{ \App\Models\User::ROLE_BRANCH_MANAGER }}">Branch Manager</option>
                                <option value="{{ \App\Models\User::ROLE_ADMINISTRATOR }}">Administrator</option>
                            </select>
                        </div>

                        <div>
                            <label for="store_id" class="block text-sm font-semibold text-gray-700">Assign Store</label>
                            <select name="store_id" id="store_id"
                                class="mt-1 block w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                                <option value="">Select a store...</option>
                                @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-1">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                class="mt-1 block w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                        </div>

                        <div class="sm:col-span-1">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="mt-1 block w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end space-x-4">
                        <a href="{{ route('viewUsers') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-700 transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script></script>
@endpush