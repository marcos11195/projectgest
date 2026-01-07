<?php
declare(strict_types=1);

namespace Core\Middleware;

class SessionMiddleware
{
    /**
     * Controladores públicos (sin login)
     */
    protected array $publicControllers = [
        'HomeController',
        'AuthController'
    ];

    /**
     * Métodos públicos concretos (opcional)
     * Ej: LoginController@index
     */
    protected array $publicMethods = [
        'AuthController@login',
        'AuthController@register'
    ];

    public function handle(string $controller, string $method): void
    {
        // Si el controlador es público → pasar
        if (in_array($controller, $this->publicControllers)) {
            return;
        }

        // Si el método concreto es público → pasar
        if (in_array("$controller@$method", $this->publicMethods)) {
            return;
        }

        // Comprobamos sesión
        if (!$this->isAuthenticated()) {
            header('Location: ' . BASE_URL);
            exit;
        }
    }

    protected function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }
}