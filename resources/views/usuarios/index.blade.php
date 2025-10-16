<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Usuarios
        </h2>
        <a href="{{ route('usuarios.create') }}"
    class="">
    + Nuevo Usuario
    </a>

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('usuarios.create') }}"
               class="inline-block mb-4 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
               Nuevo Usuario
            </a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->nombreUsuario }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->role->nombre ?? 'Sin rol' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('usuarios.edit', $usuario) }}"
                                       class="inline-block px-3 py-1 bg-yellow-600 text-black rounded hover:bg-yellow-700 mr-2">
                                        Editar
                                    </a>

                                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No hay usuarios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
