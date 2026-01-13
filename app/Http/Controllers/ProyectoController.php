<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::latest()->get();

        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Proyecto::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => 'Pendiente',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('proyectos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {

        $proyecto->load('tareas.subtareas');

        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $this->authorizeProyecto($proyecto);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:Pendiente,Completado',
        ]);

        $proyecto->update($request->only('titulo', 'descripcion', 'estado'));

        return redirect()->route('proyectos.show', $proyecto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        $this->authorizeProyecto($proyecto);

        $proyecto->delete();

        return redirect()->route('proyectos.index');
    }

    //Se pone en las funciones para validar si el usuario que hara esa accion tiene el permiso para hacerlo
    private function authorizeProyecto(Proyecto $proyecto)
    {
        if ($proyecto->user_id != auth()->id()) {
            abort(403);
        }
    }
}
