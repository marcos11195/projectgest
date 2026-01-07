<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'usuario_id';

    protected $fillable = [
        'nombre',
        'email',
        'password',
    ];

    public $timestamps = true;

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'usuario_id');
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'usuario_id');
    }
}
