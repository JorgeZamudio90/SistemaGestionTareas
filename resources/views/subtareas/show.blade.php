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
            
            {{-- Comentarios --}}
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Comentarios</h3>

                {{-- Formulario crear comentario --}}
                <form method="POST" action="{{ route('comentarios.store', ['tipo' => 'subtarea', 'id' => $subtarea->id]) }}">
                    @csrf
                    <textarea
                        name="contenido"
                        placeholder="Escribe un comentario..."
                        class="w-full border-gray-300 rounded-md shadow-sm mb-2"
                        required
                    >{{ old('contenido') }}</textarea>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Agregar Comentario
                    </button>
                </form>

                {{-- Listado de comentarios con scroll --}}
                <div class="mt-4 max-h-96 overflow-y-auto border border-gray-200 rounded p-2">
                    @if($subtarea->comentarios->isEmpty())
                        <p class="text-gray-500">No hay comentarios.</p>
                    @else
                        <ul class="space-y-2">
                            @foreach($subtarea->comentarios as $comentario)
                                <li class="border p-2 rounded">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <strong>{{ $comentario->usuario->name }}</strong>
                                            <span class="text-gray-400 text-sm ml-2">({{ $comentario->created_at->format('d/m/Y H:i') }})</span>
                                            
                                            {{-- Contenido del comentario --}}
                                            <p class="mt-1 comentario-text">{{ $comentario->contenido }}</p>

                                            {{-- Formulario para editar (oculto por defecto) --}}
                                            <form method="POST" action="{{ route('comentarios.update', $comentario) }}" class="editar-comentario-form hidden mt-1">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="contenido" value="{{ $comentario->contenido }}" class="w-full border-gray-300 rounded-md px-2 py-1 mb-1" required>
                                                <div class="flex space-x-2">
                                                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                                        Guardar
                                                    </button>
                                                    <button type="button" class="cancelar-edicion bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">
                                                        Cancelar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="flex flex-col ml-2 space-y-1">
                                            <button type="button" class="text-indigo-600 hover:underline editar-comentario-btn">Editar</button>
                                            <form method="POST" action="{{ route('comentarios.destroy', $comentario) }}" onsubmit="return confirm('¿Eliminar este comentario?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:underline">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            {{-- Script para mostrar/ocultar formulario de edición --}}
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                const editarBtns = document.querySelectorAll('.editar-comentario-btn');
                editarBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const li = btn.closest('li');
                        li.querySelector('.editar-comentario-form').classList.remove('hidden');
                        li.querySelector('.comentario-text').classList.add('hidden');
                        btn.classList.add('hidden');
                    });
                });

                const cancelarBtns = document.querySelectorAll('.cancelar-edicion');
                cancelarBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const li = btn.closest('li');
                        li.querySelector('.editar-comentario-form').classList.add('hidden');
                        li.querySelector('.comentario-text').classList.remove('hidden');
                        li.querySelector('.editar-comentario-btn').classList.remove('hidden');
                    });
                });
            });
            </script>



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
        </div>
    </div>
</x-app-layout>