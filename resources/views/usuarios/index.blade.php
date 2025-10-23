<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usuarios por Rol
            </h2>
         <a href="{{ route('usuarios.create') }}" class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800 transition">
            + Nuevo Usuario
        </a>

        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla de Docentes -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Docentes</h3>
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Completo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CI</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Carrera</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($usuarios->where('role_id', 1) as $usuario)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $usuario->nombreUsuario }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->nombre }} {{ $usuario->paterno }} {{ $usuario->materno }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->ci }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->docente?->carrera ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                        <a href="{{ route('usuarios.edit', $usuario) }}" class="px-3 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500 transition">Editar</a>
                                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay docentes registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabla de Pasantes -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Pasantes</h3>
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Completo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CI</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pasantía</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($usuarios->where('role_id', 3) as $usuario)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $usuario->nombreUsuario }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->nombre }} {{ $usuario->paterno }} {{ $usuario->materno }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->ci }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        Inicio: {{ $usuario->pasantia?->fechaInicio ?? '-' }} <br>
                                        Fin: {{ $usuario->pasantia?->fechaFinal ?? '-' }} <br>
                                        Hora: {{ $usuario->pasantia?->horaIngreso ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                        <a href="{{ route('usuarios.edit', $usuario) }}" class="px-3 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500 transition">Editar</a>
                                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay pasantes registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
