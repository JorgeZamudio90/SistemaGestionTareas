<form method="POST" action="{{ route('proyectos.update', $proyecto) }}">
    @csrf
    @method('PUT')

    <input type="text" name="titulo" value="{{ $proyecto->titulo }}">
    <textarea name="descripcion">{{ $proyecto->descripcion }}</textarea>

    <select name="estado">
        <option value="Pendiente" @selected($proyecto->estado === 'Pendiente')>Pendiente</option>
        <option value="Completado" @selected($proyecto->estado === 'Completado')>Completado</option>
    </select>

    <button class="btn btn-primary">Actualizar</button>
</form>

<form method="POST" action="{{ route('proyectos.destroy', $proyecto) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger">Eliminar</button>
</form>