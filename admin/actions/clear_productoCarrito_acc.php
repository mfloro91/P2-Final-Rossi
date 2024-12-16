<?PHP

require_once '../../functions/autoload.php';

Carrito::clear_producto();
header('Location: ../../index.php?sec=carrito');