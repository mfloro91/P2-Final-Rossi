<?PHP

require_once '../../functions/autoload.php';

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;

// Elimino de la bbdd
try {

$categoria = Categoria::get_x_id($id);
$categoria->delete();

Alerta::agregar_alerta('success', "La categoría se eliminó correctamente");

} catch (Exception $e) {
    Alerta::agregar_alerta('danger', "Hubo un error y no se pudo eliminar la categoría. Para solucionarlo, contactate con el administrador del sistema");
}

// Funcion header de php cambia encabezados de la página - redirecciona a la pagina admin

header('Location: ../index.php?sec=admin_categoria');