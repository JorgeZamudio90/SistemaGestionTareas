<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tareas del Proyecto: {{ $proyecto->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Crear Tarea --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Nueva Tarea</h3>

                <form method="POST" action="{{ route('proyectos.tareas.store', $proyecto) }}">
                    @csrf

                    <div class="mb-4">
                        <input
                            type="text"
                            name="titulo"
                            placeholder="Título"
                            class="w-full border-gray-300 rounded-md"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <textarea
                            name="descripcion"
                            placeholder="Descripción"
                            class="w-full border-gray-300 rounded-md"
                        ></textarea>
                    </div>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Crear Tarea
                    </button>
                </form>
            </div>

            {{-- Listado --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Listado de Tareas</h3>

                @if($tareas->isEmpty())
                    <p class="text-gray-500">No hay tareas registradas.</p>
                @else
                    <table class="min-w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">Título</th>
                                <th class="border px-4 py-2">Estado</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tareas as $tarea)
                                <tr>
                                    <td class="border px-4 py-2">{{ $tarea->titulo }}</td>
                                    <td class="border px-4 py-2">{{ $tarea->estado }}</td>
                                    <td class="border px-4 py-2">
                                        <a
                                            href="{{ route('proyectos.tareas.show', [$proyecto, $tarea]) }}"
                                            class="text-blue-600"
                                        >
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route('tareas.subtareas.index', $tarea) }}"
                                            class="text-indigo-600 hover:underline"
                                        >
                                            Subtareas
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('proyectos.tareas.destroy', [$proyecto, $tarea]) }}"
                                            class="inline"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 ml-2">
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