<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Usuario;

class TareaController extends Controller
{
    private function checkAuth()
    {
        if (empty($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/auth/login");
            exit;
        }
    }

    private function actualizarEstadoProyecto($proyecto_id)
    {
        $proyecto = Proyecto::find($proyecto_id);
        if (!$proyecto)
            return;

        $total = Tarea::where('proyecto_id', $proyecto_id)->count();
        $completadas = Tarea::where('proyecto_id', $proyecto_id)
            ->where('estado_id', 3)
            ->count();

        if ($total > 0 && $total === $completadas) {
            $proyecto->update(['fecha_fin' => date('Y-m-d')]);
        } else {
            $proyecto->update(['fecha_fin' => null]);
        }
    }

    public function index($proyecto_id)
    {
        $this->checkAuth();

        $proyecto = Proyecto::find($proyecto_id);

        $esDueno = ($proyecto->usuario_id == $_SESSION['user_id']);
        $esAsignado = Tarea::where('proyecto_id', $proyecto_id)
            ->where('usuario_id', $_SESSION['user_id'])
            ->exists();

        if (!$esDueno && !$esAsignado) {
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

        $proyecto = Proyecto::where('proyecto_id', $proyecto_id)
            ->where('usuario_id', $_SESSION['user_id'])
            ->first();

        if (!$proyecto)
            die("No tienes acceso a este proyecto");

        $estados = Estado::all();
        $usuarios = Usuario::all();

        return $this->view('tarea/create', compact('proyecto', 'estados', 'usuarios'));
    }

    public function store($proyecto_id)
    {
        $this->checkAuth();

        $proyecto = Proyecto::where('proyecto_id', $proyecto_id)
            ->where('usuario_id', $_SESSION['user_id'])
            ->first();

        if (!$proyecto)
            die("No tienes acceso a este proyecto");

        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $estado_id = $_POST['estado_id'] ?? null;
        $usuario_id = $_POST['usuario_id'] ?? null;

        if (!$titulo)
            die("El título es obligatorio");

        Tarea::create([
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'comentarios' => null,
            'estado_id' => $estado_id,
            'usuario_id' => $usuario_id,
            'proyecto_id' => $proyecto_id
        ]);

        $this->actualizarEstadoProyecto($proyecto_id);

        header("Location: " . BASE_URL . "/tarea/index/$proyecto_id");
        exit;
    }

    public function edit($tarea_id)
    {
        $this->checkAuth();

        $tarea = Tarea::find($tarea_id);
        if (!$tarea)
            die("Tarea no encontrada");

        $proyecto = Proyecto::find($tarea->proyecto_id);

        $esDueno = ($proyecto->usuario_id == $_SESSION['user_id']);
        $esAsignado = ($tarea->usuario_id == $_SESSION['user_id']);

        if (!$esDueno && !$esAsignado) {
            die("No tienes permiso para editar esta tarea");
        }

        $estados = Estado::all();
        $usuarios = Usuario::all();

        return $this->view('tarea/edit', compact('tarea', 'proyecto', 'estados', 'usuarios', 'esDueno', 'esAsignado'));
    }

    public function update($tarea_id)
    {
        $this->checkAuth();

        $tarea = Tarea::find($tarea_id);
        if (!$tarea)
            die("Tarea no encontrada");

        $proyecto = Proyecto::find($tarea->proyecto_id);

        $esDueno = ($proyecto->usuario_id == $_SESSION['user_id']);
        $esAsignado = ($tarea->usuario_id == $_SESSION['user_id']);

        if (!$esDueno && !$esAsignado) {
            die("No tienes permiso para editar esta tarea");
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $comentarios = trim($_POST['comentarios'] ?? '');
        $estado_id = $_POST['estado_id'] ?? null;
        $usuario_id = $_POST['usuario_id'] ?? null;

        $data = [];

        if ($esDueno) {
            $data['titulo'] = $titulo;
            $data['descripcion'] = $descripcion;
            $data['usuario_id'] = $usuario_id;
        }

        if ($esAsignado) {
            $data['comentarios'] = $comentarios;
        }

        $data['estado_id'] = $estado_id;

        $tarea->update($data);

        $this->actualizarEstadoProyecto($proyecto->proyecto_id);

        header("Location: " . BASE_URL . "/tarea/index/{$proyecto->proyecto_id}");
        exit;
    }

    public function delete($tarea_id)
    {
        $this->checkAuth();

        $tarea = Tarea::find($tarea_id);
        if (!$tarea)
            die("Tarea no encontrada");

        $proyecto = Proyecto::find($tarea->proyecto_id);

        if ($proyecto->usuario_id != $_SESSION['user_id']) {
            die("Solo el dueño del proyecto puede eliminar tareas");
        }

        $tarea->delete();

        $this->actualizarEstadoProyecto($proyecto->proyecto_id);

        header("Location: " . BASE_URL . "/tarea/index/{$proyecto->proyecto_id}");
        exit;
    }
}
