<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProyectoRequest;
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
    public function store(ProyectoRequest $request)
    {
        $request->validated();

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
    public function update(ProyectoRequest $request, Proyecto $proyecto)
    {
        if ($proyecto->user_id != auth()->id()) {
            return redirect()
                ->route('proyectos.index')
                ->with('error', 'No tienes permiso para editar este proyecto.')
                ->send();
        }

        $request->validated();

        $proyecto->update($request->only('titulo', 'descripcion', 'estado'));

        return redirect()->route('proyectos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        if ($proyecto->user_id != auth()->id()) {
            return redirect()
                ->route('proyectos.index')
                ->with('error', 'No tienes permiso para eliminar este proyecto.')
                ->send();
        }

        $proyecto->delete();

        return redirect()->route('proyectos.index');
    }
}
