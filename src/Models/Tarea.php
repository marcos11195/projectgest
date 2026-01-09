<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tarea';
    protected $primaryKey = 'tarea_id';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'comentarios',
        'estado_id',
        'usuario_id',   // usuario asignado
        'proyecto_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id', 'proyecto_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'estado_id');
    }
}
