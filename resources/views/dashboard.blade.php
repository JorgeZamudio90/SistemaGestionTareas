<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sistema de Gestión de Tareas Jerárquicas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">
                        Bienvenido, <strong>{{ auth()->user()->name }}</strong>
                    </p>

                    <a href="{{ route('proyectos.index') }}"
                       class="inline-block bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
                        Ir a Proyectos
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>