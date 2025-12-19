<?php

namespace Controllers;

use Controllers\PublicController;
use Dao\Productos as ProductosDAO;
use Utilities\Site;
use Utilities\Validators;
use Views\Renderer;

const LIST_URL = "index.php?page=Productos";
const XSR_KEY = "xsrToken_productos";

class Producto extends PublicController
{
    private array $viewData;
    private array $modes;

    public function __construct()
    {
        $this->modes = [
            "INS" => 'Creando nuevo Producto',
            "UPD" => 'Modificando Producto %s %s',
            "DEL" => 'Eliminando Producto %s %s',
            "DSP" => 'Mostrando Detalle de %s %s'
        ];

        $this->viewData = [
            "id_producto" => 0,
            "nombre" => "",
            "tipo" => "",
            "precio" => "",
            "marca" => "",
            "fecha_lanzamiento" => "",
            "mode" => "INS",
            "modeDsc" => "",
            "errores" => [],
            "readonly" => "",
            "showAction" => true,
            "xsrToken" => ""
        ];
    }

    public function run(): void
    {
        $this->capturarModoPantalla();
        $this->datosDeDao();

        if ($this->isPostBack()) {
            $this->datosFormulario();
            $this->validarDatos();
            if (count($this->viewData["errores"]) === 0) {
                $this->procesarDatos();
            }
        }

        $this->prepararVista();
        Renderer::render("producto", $this->viewData);
    }

    private function throwError(string $message)
    {
        Site::redirectToWithMsg(LIST_URL, $message);
    }

    private function capturarModoPantalla()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->modes[$this->viewData["mode"]])) {
                $this->throwError("Solicitud inválida.");
            }
        }
    }

    private function datosDeDao()
    {
        if ($this->viewData["mode"] !== "INS") {
            if (!isset($_GET["id"])) {
                $this->throwError("ID no proporcionado.");
            }

            $this->viewData["id_producto"] = intval($_GET["id"]);
            $producto = ProductosDAO::getProductoById($this->viewData["id_producto"]);

            if (!$producto) {
                $this->throwError("Producto no encontrado.");
            }

            $this->viewData = array_merge($this->viewData, $producto);
        }
    }

    private function datosFormulario()
    {
        $this->viewData["nombre"] = $_POST["nombre"] ?? "";
        $this->viewData["tipo"] = $_POST["tipo"] ?? "";
        $this->viewData["precio"] = $_POST["precio"] ?? "";
        $this->viewData["marca"] = $_POST["marca"] ?? "";
        $this->viewData["fecha_lanzamiento"] = $_POST["fecha_lanzamiento"] ?? "";
        $this->viewData["xsrToken"] = $_POST["xsrToken"] ?? "";
    }

    private function validarDatos()
    {
        if (Validators::IsEmpty($this->viewData["nombre"])) {
            $this->viewData["errores"]["nombre"] = "El nombre es requerido";
        }
        if (Validators::IsEmpty($this->viewData["tipo"])) {
            $this->viewData["errores"]["tipo"] = "El tipo es requerido";
        }
        if (Validators::IsEmpty($this->viewData["precio"])) {
            $this->viewData["errores"]["precio"] = "El precio es requerido";
        }
        if (Validators::IsEmpty($this->viewData["marca"])) {
            $this->viewData["errores"]["marca"] = "La marca es requerida";
        }
        if (Validators::IsEmpty($this->viewData["fecha_lanzamiento"])) {
            $this->viewData["errores"]["fecha_lanzamiento"] = "La fecha es requerida";
        }

        if (($this->viewData["xsrToken"] ?? "") !== ($_SESSION[XSR_KEY] ?? "")) {
            $this->throwError("Token inválido.");
        }
    }

    private function procesarDatos()
    {
        switch ($this->viewData["mode"]) {
            case "INS":
                ProductosDAO::nuevoProducto(
                    $this->viewData["nombre"],
                    $this->viewData["tipo"],
                    floatval($this->viewData["precio"]),
                    $this->viewData["marca"],
                    $this->viewData["fecha_lanzamiento"]
                );
                break;

            case "UPD":
                ProductosDAO::actualizarProducto(
                    $this->viewData["id_producto"],
                    $this->viewData["nombre"],
                    $this->viewData["tipo"],
                    floatval($this->viewData["precio"]),
                    $this->viewData["marca"],
                    $this->viewData["fecha_lanzamiento"]
                );
                break;

            case "DEL":
                ProductosDAO::eliminarProducto($this->viewData["id_producto"]);
                break;
        }

        Site::redirectToWithMsg(LIST_URL, "Operación realizada correctamente.");
    }

    private function prepararVista()
    {
        $this->viewData["modeDsc"] = $this->modes[$this->viewData["mode"]];

        if ($this->viewData["mode"] === "DEL" || $this->viewData["mode"] === "DSP") {
            $this->viewData["readonly"] = "readonly";
        }

        if ($this->viewData["mode"] === "DSP") {
            $this->viewData["showAction"] = false;
        }

        $this->viewData["xsrToken"] = hash("sha256", random_int(0, 1000000) . time());
        $_SESSION[XSR_KEY] = $this->viewData["xsrToken"];
    }
}
