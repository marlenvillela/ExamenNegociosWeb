<?php

namespace Controllers\Examen;

use Controllers\PublicController;
use Dao\Examen\Libros as LibrosDAO;
use Views\Renderer;

class Libros extends PublicController
{
    private array $viewData;

    public function __construct()
    {
        $this->viewData = [
            "libros" => []
        ];
    }

    public function run(): void
    {
        $this->viewData["libros"] = LibrosDAO::getLibros();
        Renderer::render("examen/libros", $this->viewData);
    }
}
