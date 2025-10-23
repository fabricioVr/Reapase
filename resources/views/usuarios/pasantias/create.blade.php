<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Pasantía
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('pasantias.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="idUser" class="block text-sm font-medium text-gray-700">Usuario (Pasante):</label>
                    <select id="idUser" name="idUser" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Seleccione un usuario</option>
                        @foreach(\App\Models\User::where('role_id', 3)->get() as $user)
                            <option value="{{ $user->id }}" {{ old('idUser') == $user->id ? 'selected' : '' }}>
                                {{ $user->nombre }} {{ $user->paterno }} {{ $user->materno }}
                            </option>
                        @endforeach
                    </select>
                    @error('idUser')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="fechaInicio" class="block text-sm font-medium text-gray-700">Fecha de Inicio:</label>
                    <input id="fechaInicio" name="fechaInicio" type="date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('fechaInicio') }}">
                    @error('fechaInicio')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="fechaFinal" class="block text-sm font-medium text-gray-700">Fecha Final:</label>
                    <input id="fechaFinal" name="fechaFinal" type="date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('fechaFinal') }}">
                    @error('fechaFinal')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="horaIngreso" class="block text-sm font-medium text-gray-700">Hora de Ingreso:</label>
                    <input id="horaIngreso" name="horaIngreso" type="time"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('horaIngreso') }}">
                    @error('horaIngreso')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-4">
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                        Guardar
                    </button>
                    <a href="{{ route('pasantias.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
