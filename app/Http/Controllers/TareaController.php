<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Proyecto $proyecto)
    {
        $tareas = $proyecto->tareas()->latest()->get();

        return view('tareas.index', compact('proyecto', 'tareas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $proyecto->tareas()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => 'Pendiente',
        ]);

        return redirect()
            ->route('proyectos.tareas.index', $proyecto)
            ->with('success', 'Tarea creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto, Tarea $tarea)
    {
        return view('tareas.show', compact('proyecto', 'tarea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto, Tarea $tarea)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:Pendiente,Completado',
        ]);

        $tarea->update($request->only('titulo', 'descripcion', 'estado'));

        return redirect()
            ->route('proyectos.tareas.index', $proyecto)
            ->with('success', 'Tarea actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto, Tarea $tarea)
    {
        $tarea->delete();

        return redirect()
            ->route('proyectos.tareas.index', $proyecto)
            ->with('success', 'Tarea eliminada');
    }
}
