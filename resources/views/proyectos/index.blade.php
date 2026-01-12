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
                        <input
                            type="text"
                            name="titulo"
                            placeholder="Título"
                            value="{{ old('titulo') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            required
                        >
                        @error('titulo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <textarea
                            name="descripcion"
                            placeholder="Descripción"
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
                                    <td class="px-4 py-2 border">
                                        {{ $proyecto->titulo }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ $proyecto->descripcion ?? '—' }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ $proyecto->estado }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        <a
                                            href="{{ route('proyectos.show', $proyecto) }}"
                                            class="text-blue-600 hover:underline"
                                        >
                                            Ver
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('proyectos.destroy', $proyecto) }}"
                                            class="inline"
                                            onsubmit="return confirm('¿Eliminar proyecto?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline ml-2">
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