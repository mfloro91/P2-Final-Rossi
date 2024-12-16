<?PHP
require_once "../../functions/autoload.php";

$productosCarrito = Carrito::get_carrito();
$userID = $_SESSION['usuarioLogueado']['id'] ?? FALSE;

try {

    if ($userID) {

        $datosCompra = [
            "id_usuario" => $userID,
            "fecha" => date("Y-m-d"),
            "importe" => Carrito::precio_total()
        ];

        $detalleCompra = [];

        foreach ($productosCarrito as $key => $value) {
            $detalleCompra[$key] = $value['cantidad'];
        }

        Checkout::insert_checkout_data($datosCompra, $detalleCompra);
        Carrito::clear_producto();

        Alerta::agregar_alerta('success', "Su compra se realizó correctamente, nos estaremos contactando por mail para pactar el envio");
        header('location: ../../index.php?sec=panelusuario');
    } else {
        Alerta::agregar_alerta('warning', "Su sesión expiró. Por favor, ingrese nuevamente");
        header('location: ../../index.php?sec=login');
    }
} catch (Exception $e) {
    Alerta::agregar_alerta('warning', "No se pudo finalizar la compra");
}

header('location: ../../index.php?sec=panelusuario');