<?PHP

require_once '../../functions/autoload.php';

$postData = $_POST;

if(!empty($postData)) {
    Carrito::actualizar_cantidades($postData['cantidad']);
    header('Location: ../../index.php?sec=carrito');
}