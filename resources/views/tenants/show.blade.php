<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tenant Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Name</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $tenant->name }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Email</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $tenant->email }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Domain</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $tenant->domain }}</p>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('tenants.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Back to List
                            </a>
                            <a href="{{ route('tenants.edit', $tenant) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit Tenant
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 