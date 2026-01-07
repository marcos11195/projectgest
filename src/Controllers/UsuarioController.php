<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index(): void
    {
        $ususario = Usuario::all();
        $this->view('usuario/index', [
            'titulo' => 'Gestión de Usuarios',
            'mensaje' => 'Bienvenido a la gestión de usuarios 🚀',
            'usuarios' => $ususario
        ]);
    }


}