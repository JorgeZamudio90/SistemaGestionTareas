<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tarea: {{ $tarea->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Información --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <p><strong>Proyecto:</strong> {{ $proyecto->titulo }}</p>
                <p><strong>Estado:</strong> {{ $proyecto->estado }}</p>
            </div>

            {{-- Actualizar --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Actualizar Tarea</h3>

                <form
                    method="POST"
                    action="{{ route('proyectos.tareas.update', [$proyecto, $tarea]) }}"
                >
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1">Título</label>
                        <input
                            type="text"
                            name="titulo"
                            value="{{ old('titulo', $tarea->titulo) }}"
                            class="w-full border-gray-300 rounded-md"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Descripción</label>
                        <textarea
                            name="descripcion"
                            class="w-full border-gray-300 rounded-md"
                        >{{ old('descripcion', $tarea->descripcion) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Estado</label>
                        <select
                            name="estado"
                            class="w-full border-gray-300 rounded-md"
                        >
                            <option value="Pendiente" @selected($tarea->estado === 'Pendiente')>
                                Pendiente
                            </option>
                            <option value="Completado" @selected($tarea->estado === 'Completado')>
                                Completado
                            </option>
                        </select>
                    </div>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Guardar Cambios
                    </button>
                </form>
            </div>

            {{-- Eliminar --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4 text-red-600">
                    Eliminar Tarea
                </h3>

                <form
                    method="POST"
                    action="{{ route('proyectos.tareas.destroy', [$proyecto, $tarea]) }}"
                    onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?')"
                >
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 text-white px-4 py-2 rounded">
                        Eliminar
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>