namespace Controllers;


use Controllers\PublicController;
use Dao\Productos as ProductosDAO;
use Views\Renderer;


class Productos extends PublicController
{
    private array $viewData;


    public function __construct()
    {
        $this->viewData = [
            "productos" => []
        ];
    }


    public function run(): void
    {
        // Obtener productos desde el DAO
        $this->viewData["productos"] = ProductosDAO::getProductos();


        // Renderizar la vista correcta
        Renderer::render("productos", $this->viewData);
    }
}


