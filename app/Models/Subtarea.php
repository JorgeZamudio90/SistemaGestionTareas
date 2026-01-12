<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subtarea extends Model
{
    use HasFactory;

    protected $table = 'subtareas';

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'tarea_id',
    ];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }
}
