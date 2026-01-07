<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // Buscar usuario por email
            $usuario = Usuario::where('email', $email)->first();

            // Validar usuario y contraseña
            if (!$usuario || !password_verify($password, $usuario->password)) {
                $error = "Credenciales incorrectas";
                return $this->view('usuario/login', compact('error'));
            }

            // Guardar sesión
            $_SESSION['user_id'] = $usuario->id;
            $_SESSION['user_email'] = $usuario->email;

            // Redirigir al dashboard
            header("Location: " . BASE_URL . "/usuario/index");
            exit;
        }

        // GET: mostrar formulario
        return $this->view('usuario/login');
    }

    public function logout()
    {
        session_destroy();
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            try {
                $nombre = trim($_POST['nombre'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $password = trim($_POST['password'] ?? '');

                // Validaciones básicas
                if (!$nombre || !$email || !$password) {
                    throw new \Exception("Todos los campos son obligatorios");
                }

                // Comprobar si el email ya existe
                if (Usuario::where('email', $email)->exists()) {
                    throw new \Exception("El email ya está registrado");
                }

                // Crear usuario
                Usuario::create([
                    'nombre' => $nombre,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ]);

                // Redirigir al login
                header("Location: " . BASE_URL . "/auth/login");
                exit;

            } catch (\Exception $e) {
                // Captura cualquier error y lo envía a la vista
                $error = $e->getMessage();
                return $this->view('usuario/register', compact('error'));
            }
        }

        return $this->view('usuario/register');
    }


}
