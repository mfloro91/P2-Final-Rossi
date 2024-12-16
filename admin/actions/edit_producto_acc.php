<?PHP

require_once '../../functions/autoload.php';

$postData = $_POST;
$datosArchivo = $_FILES['img'] ?? FALSE;
$categoria = $postData['categoria_id'];
$id = $_GET['id'] ?? FALSE;

//echo "<pre>";
//erint_r($postData);
//echo "</pre>";

//echo "<pre>";
//erint_r($datosArchivo);
//echo "</pre>";


try {

    $producto = Producto::productoId($id);

    $producto->limpiar_materiales();

    if (isset($postData['material'])) {
        foreach ($postData['material'] as $material_id) {
            $producto->add_materiales($id, $material_id);
        }
    }

    if (!empty($datosArchivo['tmp_name'])) {
        $imagen = Imagen::subirImagen(__DIR__ . "/../../imagenes/productos", $datosArchivo);
        Imagen::borrarImagen(__DIR__ . "/../../imagenes/productos" . $postData['img_og']);
    } else {
        $imagen = $postData['img_og'];
    }


    $producto->edit(
        $postData['categoria_id'],
        $postData['nombre'],
        $postData['descripcion'],
        $postData['precio'],
        $postData['fecha_origen'],
        $postData['lugar_origen_id'],
        $postData['stock'],
        $imagen,
        $postData['alt'],
    );

    Alerta::agregar_alerta('success', "El producto se editó correctamente");
    
} catch (Exception $e) {

    Alerta::agregar_alerta('danger', "Hubo un error y no se pudo editar el producto. Para solucionarlo, contactate con el administrador del sistema");
}


header('Location: ../index.php?sec=admin_producto');
