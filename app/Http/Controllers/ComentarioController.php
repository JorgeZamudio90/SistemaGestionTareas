<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComentarioRequest;
use App\Models\Comentario;
use App\Models\Proyecto;
use App\Models\Subtarea;
use App\Models\Tarea;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComentarioRequest $request, $tipo, $id)
    {
        $request->validated();

        // Determinar el modelo según $tipo
        $modelo = match($tipo) {
            'proyecto' => Proyecto::findOrFail($id),
            'tarea' => Tarea::findOrFail($id),
            'subtarea' => Subtarea::findOrFail($id),
        };

        $modelo->comentarios()->create([
            'contenido' => $request->contenido,
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComentarioRequest $request, Comentario $comentario)
    {
        // Validación
        $request->validated();

        // Solo el usuario que creó el comentario puede actualizarlo
        if ($comentario->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este comentario.');
        }

        $comentario->update([
            'contenido' => $request->contenido,
        ]);

        return back()->with('success', 'Comentario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentario $comentario)
    {
        if ($comentario->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
        }
        $comentario->delete();
        return back()->with('success', 'Comentario eliminado correctamente.');
    }
}
