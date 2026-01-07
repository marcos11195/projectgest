<?php

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/index', [
            'titulo' => 'Bienvenido a Formacom MVC',
            'mensaje' => 'Esta es la página principal'
        ]);
    }
}
