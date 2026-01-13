<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Sistema de Gestión de Tareas Jerárquicas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Tarjeta de bienvenida --}}
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white shadow-lg rounded-xl p-6 sm:p-8">
                <h3 class="text-2xl font-bold mb-2">¡Bienvenido, {{ auth()->user()->name }}!</h3>
                <p class="text-sm sm:text-base">Gestiona tus proyectos, tareas y subtareas de manera eficiente y organizada.</p>
            </div>

            {{-- Acciones rápidas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Proyectos --}}
                <a href="{{ route('proyectos.index') }}"
                   class="bg-white shadow hover:shadow-xl rounded-xl p-6 flex flex-col justify-between hover:bg-blue-50 transition duration-300">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-700 mb-2">Proyectos</h4>
                        <p class="text-sm text-gray-500">Visualiza, crea y administra todos tus proyectos.</p>
                    </div>
                    <div class="mt-4">
                        <span class="inline-block bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition duration-300">
                            Ir a Proyectos
                        </span>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
