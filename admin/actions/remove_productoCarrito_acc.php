<?PHP

require_once '../../functions/autoload.php';

$productoID = $_GET['id'] ?? FALSE;

if($productoID) {
    Carrito::remove_producto($productoID);
    header('Location: ../../index.php?sec=carrito');
}