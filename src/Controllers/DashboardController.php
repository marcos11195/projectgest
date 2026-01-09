<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Tarea;
use App\Models\Proyecto;

class DashboardController extends Controller
{
    public function index()
    {
        if (empty($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/auth/login");
            exit;
        }

        $usuario_id = $_SESSION['user_id'];

        // Tareas asignadas al usuario
        $tareasAsignadas = Tarea::where('usuario_id', $usuario_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        // Proyectos donde el usuario participa (creador o asignado)
        $proyectosParticipa = Proyecto::where('usuario_id', $usuario_id)
            ->orWhereIn('proyecto_id', function ($q) use ($usuario_id) {
                $q->select('proyecto_id')
                    ->from('tarea')
                    ->where('usuario_id', $usuario_id);
            })
            ->distinct()
            ->get();

        return $this->view('dashboard/index', compact('tareasAsignadas', 'proyectosParticipa'));
    }
}
