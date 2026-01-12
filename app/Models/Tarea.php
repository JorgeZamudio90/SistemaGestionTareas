<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'proyecto_id',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function subtareas()
    {
        return $this->hasMany(Subtarea::class, 'tarea_id');
    }

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }
}
