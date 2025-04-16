<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Tenant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('tenants.store') }}" class="space-y-6">
                        @csrf

                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-bold mb-2 text-gray-700">Name</label>
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Enter tenant name" />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-bold mb-2 text-gray-700">Email</label>
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="Enter email address" />
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-bold mb-2 text-gray-700">Password</label>
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required placeholder="Enter password" />
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-bold mb-2 text-gray-700">Confirm Password</label>
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required placeholder="Confirm password" />
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="domain" class="block text-sm font-bold mb-2 text-gray-700">Domain Name</label>
                            <x-input id="domain" class="block mt-1 w-full" type="text" name="domain" :value="old('domain')" required placeholder="Enter domain name" />
                            @error('domain')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4 space-x-4">
                            <a href="{{ route('tenants.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Cancel') }}
                            </a>
                            <x-button class="bg-blue-500 hover:bg-blue-700">
                                {{ __('Create Tenant') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 