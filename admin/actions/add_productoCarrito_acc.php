<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;
$cantidad = $_GET['cantidad'] ?? 1;
 
if($id){
    Carrito::add_producto($id, $cantidad);
    header('location: ../../index.php?sec=carrito');
}