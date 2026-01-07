<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Proyecto;
use App\Models\Tarea;

class DashboardController extends Controller
{
    public function index()
    {
        if (empty($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/auth/login");
            exit;
        }

        $proyectos = Proyecto::where('usuario_id', $_SESSION['user_id'])
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach ($proyectos as $p) {
            $p->total_tareas = Tarea::where('proyecto_id', $p->proyecto_id)->count();
            $p->tareas_completadas = Tarea::where('proyecto_id', $p->proyecto_id)
                ->where('estado_id', 3)
                ->count();
            $p->tareas_pendientes = $p->total_tareas - $p->tareas_completadas;
        }

        return $this->view('dashboard/index', compact('proyectos'));
    }
}
