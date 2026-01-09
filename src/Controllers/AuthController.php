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

            $usuario = Usuario::where('email', $email)->first();

            if (!$usuario || !password_verify($password, $usuario->password)) {
                $error = "Credenciales incorrectas";
                return $this->view('usuario/login', compact('error'));
            }

            // Guardar sesión correctamente
            $_SESSION['user_id'] = $usuario->usuario_id;
            $_SESSION['user_email'] = $usuario->email;

            // Redirigir al dashboard de proyectos
            header("Location: " . BASE_URL . "/dashboard");
            exit;
        }

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

                if (!$nombre || !$email || !$password) {
                    throw new \Exception("Todos los campos son obligatorios");
                }

                if (Usuario::where('email', $email)->exists()) {
                    throw new \Exception("El email ya está registrado");
                }

                Usuario::create([
                    'nombre' => $nombre,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ]);

                header("Location: " . BASE_URL . "/auth/login");
                exit;

            } catch (\Exception $e) {
                $error = $e->getMessage();
                return $this->view('usuario/register', compact('error'));
            }
        }

        return $this->view('usuario/register');
    }
}
