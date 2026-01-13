<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Subtareas de: {{ $tarea->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Formulario Crear Subtarea --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Nueva Subtarea</h3>

                <form method="POST" action="{{ route('tareas.subtareas.store', $tarea) }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1">Título</label>
                        <input
                            type="text"
                            name="titulo"
                            placeholder="Título de la subtarea"
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
                            placeholder="Descripción (opcional)"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                        >{{ old('descripcion') }}</textarea>
                    </div>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    >
                        Agregar Subtarea
                    </button>

                    <a href="{{ route('proyectos.tareas.index', [$tarea->proyecto, $tarea]) }}"
                        class="inline-block ml-3 bg-gray-200 px-3 py-2 rounded hover:bg-gray-300">
                        Volver a Tarea
                    </a>
                </form>
            </div>

            {{-- Listado de Subtareas --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Listado de Subtareas</h3>

                @if($subtareas->isEmpty())
                    <p class="text-gray-500">No hay subtareas registradas.</p>
                @else
                    <table class="min-w-full border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border text-left">Título</th>
                                <th class="px-4 py-2 border text-left">Descripción</th>
                                <th class="px-4 py-2 border text-left">Estado</th>
                                <th class="px-4 py-2 border text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subtareas as $subtarea)
                                <tr>
                                    <td class="px-4 py-2 border align-top">
                                        {{ $subtarea->titulo }}
                                    </td>
                                    <td class="px-4 py-2 border align-top">
                                        {{ \Illuminate\Support\Str::limit($subtarea->descripcion ?? '—', 100) }}
                                    </td>
                                    <td class="px-4 py-2 border align-top">
                                        <span class="inline-block px-2 py-1 rounded text-sm
                                            {{ $subtarea->estado === 'Completado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $subtarea->estado }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border align-top">
                                        <a href="{{ route('tareas.subtareas.show', [$tarea, $subtarea]) }}"
                                        class="text-blue-600 hover:underline">
                                            Ver / Editar
                                        </a>

                                        <form
                                            action="{{ route('tareas.subtareas.destroy', [$tarea, $subtarea]) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('¿Eliminar esta subtarea?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline ml-3">
                                                Eliminar
                                            </button>
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