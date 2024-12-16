<?PHP

require_once '../../functions/autoload.php';

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;

// Elimino de la bbdd

try {

    $producto = Producto::productoId($id);
    $producto->delete();
    Imagen::borrarImagen(__DIR__ . "/../../imagenes/productos" . $postData['img_og']);
    Alerta::agregar_alerta('success', "El producto se eliminó correctamente");
    
} catch (Exception $e) {
    Alerta::agregar_alerta('danger', "Hubo un error y no se pudo eliminar el producto. Para solucionarlo, contactate con el administrador del sistema");
}

// Funcion header de php cambia encabezados de la página - redirecciona a la pagina admin
header('Location: ../index.php?sec=admin_producto');



try {

    $material = Material::get_x_id($id);
    $material->delete();
    Alerta::agregar_alerta('success', "El material se eliminó correctamente");
    
    } catch (Exception $e) {
        Alerta::agregar_alerta('danger', "Hubo un error y no se pudo eliminar el material. Para solucionarlo, contactate con el administrador del sistema");
    }
    
    // Funcion header de php cambia encabezados de la página - redirecciona a la pagina admin
    
    header('Location: ../index.php?sec=admin_material');