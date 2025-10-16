<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                {{ __("You're logged in!") }}
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ url('/usuarios') }}"
                   class="inline-block px-6 py-3 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 transition duration-300">
                    Ir a Usuarios
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
