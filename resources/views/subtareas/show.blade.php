<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Subtarea: {{ $subtarea->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Info: Tarea / Proyecto --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <p class="text-sm text-gray-500 mb-2">
                    <strong>Proyecto:</strong>
                    <a href="{{ route('proyectos.show', $subtarea->tarea->proyecto) }}" class="text-blue-600 hover:underline">
                        {{ $subtarea->tarea->proyecto->titulo }}
                    </a>
                </p>

                <p class="text-sm text-gray-500 mb-2">
                    <strong>Tarea:</strong>
                    <a href="{{ route('proyectos.tareas.show', [$subtarea->tarea->proyecto, $subtarea->tarea]) }}" class="text-blue-600 hover:underline">
                        {{ $subtarea->tarea->titulo }}
                    </a>
                </p>

                <p class="mb-2"><strong>Estado:</strong>
                    <span class="inline-block px-2 py-1 rounded text-sm
                        {{ $subtarea->estado === 'Completado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $subtarea->estado }}
                    </span>
                </p>

                <p class="text-gray-700">{{ $subtarea->descripcion ?? 'Sin descripción' }}</p>
            </div>

            {{-- Actualizar Subtarea --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Editar Subtarea</h3>

                <form method="POST" action="{{ route('tareas.subtareas.update', [$subtarea->tarea, $subtarea]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1">Título</label>
                        <input
                            type="text"
                            name="titulo"
                            value="{{ old('titulo', $subtarea->titulo) }}"
                            class="w-full border-gray-300 rounded-md"
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
                            class="w-full border-gray-300 rounded-md"
                        >{{ old('descripcion', $subtarea->descripcion) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Estado</label>
                        <select name="estado" class="w-full border-gray-300 rounded-md">
                            <option value="Pendiente" @selected($subtarea->estado === 'Pendiente')>Pendiente</option>
                            <option value="Completado" @selected($subtarea->estado === 'Completado')>Completado</option>
                        </select>
                    </div>

                    <div class="flex items-center space-x-3">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Guardar cambios
                        </button>

                        <a href="{{ route('proyectos.tareas.index', [$subtarea->tarea->proyecto, $subtarea->tarea]) }}"
                           class="inline-block bg-gray-200 px-3 py-2 rounded hover:bg-gray-300">
                            Volver a la tarea
                        </a>
                    </div>
                </form>
            </div>

            {{-- Eliminar Subtarea --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4 text-red-600">Eliminar Subtarea</h3>

                <form method="POST" action="{{ route('tareas.subtareas.destroy', [$subtarea->tarea, $subtarea]) }}"
                      onsubmit="return confirm('¿Eliminar esta subtarea?')">
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Eliminar Subtarea
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>