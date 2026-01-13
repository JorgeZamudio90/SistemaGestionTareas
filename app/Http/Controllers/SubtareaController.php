<?php

namespace App\Http\Controllers;

use App\Models\Subtarea;
use App\Models\Tarea;
use Illuminate\Http\Request;

class SubtareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tarea $tarea)
    {
        $subtareas = $tarea->subtareas()->latest()->get();

        return view('subtareas.index', compact('tarea', 'subtareas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Tarea $tarea)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tarea->subtareas()->create($request->all());

        return redirect()
            ->route('tareas.subtareas.index', $tarea)
            ->with('success', 'Subtarea creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea, Subtarea $subtarea)
    {
        return view('subtareas.show', compact('tarea', 'subtarea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea, Subtarea $subtarea)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required',
        ]);

        $subtarea->update($request->all());

        return redirect()
            ->route('tareas.subtareas.index', $tarea)
            ->with('success', 'Subtarea actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea, Subtarea $subtarea)
    {
        $subtarea->delete();

        return redirect()
            ->route('tareas.subtareas.index', $tarea)
            ->with('success', 'Subtarea eliminado correctamente');
    }
}
