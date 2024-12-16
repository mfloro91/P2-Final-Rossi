<?PHP

require_once '../../functions/autoload.php';

$postData = $_POST;
$datosArchivo = $_FILES['img'];
$categoria = $postData['categoria_id'];



echo "<pre>";
print_r($postData);
echo "</pre>";


try {

    $imagen = Imagen::subirImagen(__DIR__ . "/../../imagenes/productos", $datosArchivo);
    $idProducto = Producto::insert(
        $postData['categoria_id'],
        $postData['nombre'],
        $postData['descripcion'],
        $postData['precio'],
        $postData['fecha_origen'],
        $postData['lugar_origen'],
        $postData['stock'],
        $imagen,
        $postData['alt'],
    );

    if (isset($postData['material'])) {
        foreach ($postData['material'] as $material_id) {
            Producto::add_materiales($idProducto, $material_id);
        }
    }
    Alerta::agregar_alerta('success', "El producto se agregó correctamente");
    
} catch (Exception $e) {
    Alerta::agregar_alerta('danger', "Hubo un error y no se pudo agregar el producto. Para solucionarlo, contactate con el administrador del sistema");
}


header('Location: ../index.php?sec=admin_producto');


