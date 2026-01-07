<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Estado;

class TareaController extends Controller
{
    private function checkAuth()
    {
        if (empty($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/auth/login");
            exit;
        }
    }

    private function getProyectoUsuario($proyecto_id)
    {
        return Proyecto::where('proyecto_id', $proyecto_id)
            ->where('usuario_id', $_SESSION['user_id'])
            ->first();
    }

    /**
     * 🔥 NUEVO: Actualiza automáticamente el estado del proyecto
     */
    private function actualizarEstadoProyecto($proyecto_id)
    {
        $proyecto = Proyecto::find($proyecto_id);
        if (!$proyecto)
            return;

        $total = Tarea::where('proyecto_id', $proyecto_id)->count();
        $completadas = Tarea::where('proyecto_id', $proyecto_id)
            ->where('estado_id', 3) // ID del estado "Completada"
            ->count();

        if ($total > 0 && $total === $completadas) {
            // Todas completadas → proyecto finalizado
            $proyecto->update(['fecha_fin' => date('Y-m-d')]);
        } else {
            // Hay tareas pendientes → proyecto en curso
            $proyecto->update(['fecha_fin' => null]);
        }
    }

    public function index($proyecto_id)
    {
        $this->checkAuth();

        $proyecto = $this->getProyectoUsuario($proyecto_id);

        if (!$proyecto) {
            die("No tienes acceso a este proyecto");
        }

        $tareas = Tarea::where('proyecto_id', $proyecto_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $this->view('tarea/index', compact('proyecto', 'tareas'));
    }

    public function create($proyecto_id)
    {
        $this->checkAuth();

        $proyecto = $this->getProyectoUsuario($proyecto_id);

        if (!$proyecto) {
            die("No tienes acceso a este proyecto");
        }

        $estados = Estado::all();

        return $this->view('tarea/create', compact('proyecto', 'estados'));
    }

    public function store($proyecto_id)
    {
        $this->checkAuth();

        $proyecto = $this->getProyectoUsuario($proyecto_id);

        if (!$proyecto) {
            die("No tienes acceso a este proyecto");
        }

        try {
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $comentarios = trim($_POST['comentarios'] ?? '');
            $estado_id = $_POST['estado_id'] ?? null;

            if (!$titulo) {
                throw new \Exception("El título es obligatorio");
            }

            Tarea::create([
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'comentarios' => $comentarios,
                'estado_id' => $estado_id,
                'usuario_id' => $_SESSION['user_id'],
                'proyecto_id' => $proyecto_id
            ]);

            // 🔥 Actualizar estado del proyecto
            $this->actualizarEstadoProyecto($proyecto_id);

            header("Location: " . BASE_URL . "/tarea/index/$proyecto_id");
            exit;

        } catch (\Exception $e) {
            $error = $e->getMessage();
            $estados = Estado::all();
            return $this->view('tarea/create', compact('error', 'proyecto', 'estados'));
        }
    }

    public function edit($tarea_id)
    {
        $this->checkAuth();

        $tarea = Tarea::find($tarea_id);

        if (!$tarea) {
            die("Tarea no encontrada");
        }

        $proyecto = $this->getProyectoUsuario($tarea->proyecto_id);

        if (!$proyecto) {
            die("No tienes acceso a esta tarea");
        }

        $estados = Estado::all();

        return $this->view('tarea/edit', compact('tarea', 'proyecto', 'estados'));
    }

    public function update($tarea_id)
    {
        $this->checkAuth();

        $tarea = Tarea::find($tarea_id);

        if (!$tarea) {
            die("Tarea no encontrada");
        }

        $proyecto = $this->getProyectoUsuario($tarea->proyecto_id);

        if (!$proyecto) {
            die("No tienes acceso a esta tarea");
        }

        try {
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $comentarios = trim($_POST['comentarios'] ?? '');
            $estado_id = $_POST['estado_id'] ?? null;

            if (!$titulo) {
                throw new \Exception("El título es obligatorio");
            }

            $tarea->update([
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'comentarios' => $comentarios,
                'estado_id' => $estado_id
            ]);

            // 🔥 Actualizar estado del proyecto
            $this->actualizarEstadoProyecto($proyecto->proyecto_id);

            header("Location: " . BASE_URL . "/tarea/index/{$proyecto->proyecto_id}");
            exit;

        } catch (\Exception $e) {
            $error = $e->getMessage();
            $estados = Estado::all();
            return $this->view('tarea/edit', compact('error', 'tarea', 'proyecto', 'estados'));
        }
    }

    public function delete($tarea_id)
    {
        $this->checkAuth();

        $tarea = Tarea::find($tarea_id);

        if (!$tarea) {
            die("Tarea no encontrada");
        }

        $proyecto = $this->getProyectoUsuario($tarea->proyecto_id);

        if (!$proyecto) {
            die("No tienes acceso a esta tarea");
        }

        $tarea->delete();

        // 🔥 Actualizar estado del proyecto
        $this->actualizarEstadoProyecto($proyecto->proyecto_id);

        header("Location: " . BASE_URL . "/tarea/index/{$proyecto->proyecto_id}");
        exit;
    }
}
