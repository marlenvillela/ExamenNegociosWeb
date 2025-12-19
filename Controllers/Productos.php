<?php
namespace Controllers;

use Controllers\PublicController;
use Dao\Productos as ProductosDAO;
use Views\Renderer;

class Productos extends PublicController
{
    private array $viewData;

    public function __construct()
    {
        parent::__construct();
        $this->viewData = [
            "productos" => []
        ];
    }

    public function run(): void
    {
        $this->viewData["productos"] = ProductosDAO::getProductos();
        Renderer::render("productos", $this->viewData);
    }
}
