<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tareas del Proyecto: {{ $proyecto->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Formulario Crear Tarea --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Nueva Tarea</h3>

                <form method="POST" action="{{ route('proyectos.tareas.store', $proyecto) }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1">Título</label>
                        <input
                            type="text"
                            name="titulo"
                            placeholder="Título de la tarea"
                            value="{{ old('titulo') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            required
                        >
                        @error('titulo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Descripción</label>
                        <textarea
                            name="descripcion"
                            placeholder="Descripción de la tarea"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                        >{{ old('descripcion') }}</textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Crear Tarea
                    </button>
                </form>
            </div>

            {{-- Listado de Tareas --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Listado de Tareas</h3>

                @if($tareas->isEmpty())
                    <p class="text-gray-500">No hay tareas registradas.</p>
                @else
                    <table class="min-w-full border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border text-left">Título</th>
                                <th class="px-4 py-2 border text-left">Estado</th>
                                <th class="px-4 py-2 border text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tareas as $tarea)
                                <tr>
                                    <td class="px-4 py-2 border align-top">{{ $tarea->titulo }}</td>
                                    <td class="px-4 py-2 border align-top">
                                        <span class="inline-block px-2 py-1 rounded text-sm
                                            {{ $tarea->estado === 'Completado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $tarea->estado }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border align-top">
                                        <a href="{{ route('proyectos.tareas.show', [$proyecto, $tarea]) }}"
                                           class="text-blue-600 hover:underline">
                                           Ver / Editar
                                        </a>

                                        <a href="{{ route('tareas.subtareas.index', $tarea) }}"
                                           class="text-indigo-600 hover:underline ml-3">
                                           Subtareas
                                        </a>

                                        <form method="POST" action="{{ route('proyectos.tareas.destroy', [$proyecto, $tarea]) }}"
                                              class="inline ml-3" onsubmit="return confirm('¿Eliminar esta tarea?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>