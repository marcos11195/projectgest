<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Proyecto;
use App\Models\Tarea;

class ProyectoController extends Controller
{
    private function checkAuth()
    {
        if (empty($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/auth/login");
            exit;
        }
    }

    public function index()
    {
        if (empty($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/auth/login");
            exit;
        }

        $usuario_id = $_SESSION['user_id'];

        // Proyectos creados por el usuario
        $proyectosCreados = Proyecto::where('usuario_id', $usuario_id)
            ->orderBy('fecha_inicio', 'DESC')
            ->get();

        // Proyectos donde participa (pero NO es dueño)
        $proyectosParticipa = Proyecto::whereIn('proyecto_id', function ($q) use ($usuario_id) {
            $q->select('proyecto_id')
                ->from('tarea')
                ->where('usuario_id', $usuario_id);
        })
            ->where('usuario_id', '!=', $usuario_id)
            ->distinct()
            ->orderBy('fecha_inicio', 'DESC')
            ->get();

        return $this->view('proyecto/index', compact('proyectosCreados', 'proyectosParticipa'));
    }

    public function create()
    {
        $this->checkAuth();
        return $this->view('proyecto/create');
    }

    public function store()
    {
        $this->checkAuth();

        try {
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');

            if (!$titulo) {
                throw new \Exception("El título es obligatorio");
            }

            Proyecto::create([
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'fecha_inicio' => date('Y-m-d'), // AUTOMÁTICA
                'fecha_fin' => null,          // CONTROLADA POR TAREAS
                'usuario_id' => $_SESSION['user_id']
            ]);

            header("Location: " . BASE_URL . "/proyecto");
            exit;

        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $this->view('proyecto/create', compact('error'));
        }
    }

    public function edit($id)
    {
        $this->checkAuth();

        $proyecto = Proyecto::where('proyecto_id', $id)
            ->where('usuario_id', $_SESSION['user_id'])
            ->first();

        if (!$proyecto) {
            die("No tienes acceso a este proyecto");
        }

        return $this->view('proyecto/edit', compact('proyecto'));
    }

    public function update($id)
    {
        $this->checkAuth();

        $proyecto = Proyecto::where('proyecto_id', $id)
            ->where('usuario_id', $_SESSION['user_id'])
            ->first();

        if (!$proyecto) {
            die("No tienes acceso a este proyecto");
        }

        try {
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');

            if (!$titulo) {
                throw new \Exception("El título es obligatorio");
            }

            $proyecto->update([
                'titulo' => $titulo,
                'descripcion' => $descripcion
            ]);

            // Recalcular estado del proyecto
            $this->actualizarEstadoProyecto($id);

            header("Location: " . BASE_URL . "/proyecto");
            exit;

        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $this->view('proyecto/edit', compact('error', 'proyecto'));
        }
    }

    public function delete($id)
    {
        $this->checkAuth();

        $proyecto = Proyecto::where('proyecto_id', $id)
            ->where('usuario_id', $_SESSION['user_id'])
            ->first();

        if (!$proyecto) {
            die("No tienes acceso a este proyecto");
        }

        // Eliminar tareas asociadas
        Tarea::where('proyecto_id', $id)->delete();

        $proyecto->delete();

        header("Location: " . BASE_URL . "/proyecto");
        exit;
    }

    /**
     * Actualiza la fecha_fin del proyecto según el estado de sus tareas.
     */
    private function actualizarEstadoProyecto($proyecto_id)
    {
        $proyecto = Proyecto::find($proyecto_id);

        if (!$proyecto) {
            return;
        }

        $total = Tarea::where('proyecto_id', $proyecto_id)->count();
        $completadas = Tarea::where('proyecto_id', $proyecto_id)
            ->where('estado_id', 3) // ID del estado "completada"
            ->count();

        if ($total > 0 && $total === $completadas) {
            // Todas completadas → proyecto finalizado
            $proyecto->update(['fecha_fin' => date('Y-m-d')]);
        } else {
            // Aún hay tareas pendientes
            $proyecto->update(['fecha_fin' => null]);
        }
    }
}
