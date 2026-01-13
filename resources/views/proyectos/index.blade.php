<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Proyectos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Formulario Crear Proyecto --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Nuevo Proyecto</h3>

                <form method="POST" action="{{ route('proyectos.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1">Título</label>
                        <input
                            type="text"
                            name="titulo"
                            placeholder="Título del proyecto"
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
                            placeholder="Descripción del proyecto"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                        >{{ old('descripcion') }}</textarea>
                    </div>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    >
                        Crear Proyecto
                    </button>
                </form>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            {{-- Listado de Proyectos --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Listado de Proyectos</h3>

                @if($proyectos->isEmpty())
                    <p class="text-gray-500">No hay proyectos registrados.</p>
                @else
                    <table class="min-w-full border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">Título</th>
                                <th class="px-4 py-2 border">Descripción</th>
                                <th class="px-4 py-2 border">Estado</th>
                                <th class="px-4 py-2 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proyectos as $proyecto)
                                <tr>
                                    <td class="px-4 py-2 border align-top">{{ $proyecto->titulo }}</td>
                                    <td class="px-4 py-2 border align-top">{{ $proyecto->descripcion ?? '—' }}</td>
                                    <td class="px-4 py-2 border align-top">
                                        <span class="inline-block px-2 py-1 rounded text-sm
                                            {{ $proyecto->estado === 'Completado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $proyecto->estado }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border align-top">
                                        <a href="{{ route('proyectos.show', $proyecto) }}"
                                           class="text-blue-600 hover:underline">
                                           Ver / Editar
                                        </a>

                                        <a href="{{ route('proyectos.tareas.index', $proyecto) }}"
                                           class="text-indigo-600 hover:underline ml-3">
                                           Tareas
                                        </a>

                                        <form method="POST" action="{{ route('proyectos.destroy', $proyecto) }}"
                                              class="inline ml-3" onsubmit="return confirm('¿Eliminar proyecto?')">
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