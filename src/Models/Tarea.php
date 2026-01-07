<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tarea';
    protected $primaryKey = 'tarea_id';

    protected $fillable = [
        'titulo',
        'descripcion',
        'comentarios',
        'usuario_id',
        'estado_id',
        'proyecto_id',
    ];

    public $timestamps = true;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
