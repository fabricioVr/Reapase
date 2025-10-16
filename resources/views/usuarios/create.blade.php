<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Usuario
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="nombreUsuario" class="block text-sm font-medium text-gray-700">Nombre de Usuario:</label>
                    <input id="nombreUsuario" name="nombreUsuario" type="text" required autofocus
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                           value="{{ old('nombreUsuario') }}">
                    @error('nombreUsuario')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="clave" class="block text-sm font-medium text-gray-700">Contraseña:</label>
                    <input id="clave" name="clave" type="password" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" autocomplete="new-password">
                    @error('clave')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role_id" class="block text-sm font-medium text-gray-700">Rol:</label>
                    <select id="role_id" name="role_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Seleccione un rol</option>
                        @foreach(\App\Models\Role::all() as $rol)
                            <option value="{{ $rol->id }}" {{ old('role_id') == $rol->id ? 'selected' : '' }}>
                                {{ ucfirst($rol->nombre) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <input id="nombre" name="nombre" type="text" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                           value="{{ old('nombre') }}">
                    @error('nombre')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="paterno" class="block text-sm font-medium text-gray-700">Apellido Paterno:</label>
                    <input id="paterno" name="paterno" type="text" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                           value="{{ old('paterno') }}">
                    @error('paterno')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="materno" class="block text-sm font-medium text-gray-700">Apellido Materno:</label>
                    <input id="materno" name="materno" type="text"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                           value="{{ old('materno') }}">
                    @error('materno')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="ci" class="block text-sm font-medium text-gray-700">CI:</label>
                    <input id="ci" name="ci" type="text" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                           value="{{ old('ci') }}">
                    @error('ci')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-4">
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                        Guardar
                    </button>
                    <a href="{{ route('usuarios.index') }}"
                       class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
