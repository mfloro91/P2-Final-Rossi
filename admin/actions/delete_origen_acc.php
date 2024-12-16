<?PHP

require_once '../../functions/autoload.php';

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;

// Elimino de la bbdd
try {

$origen = Origen::get_x_id($id);
$origen->delete();
Alerta::agregar_alerta('success', "El lugar de origen se eliminó correctamente");

} catch (Exception $e) {
    Alerta::agregar_alerta('danger', "Hubo un error y no se pudo eliminar el lugar de origen. Para solucionarlo, contactate con el administrador del sistema");
}

// Funcion header de php cambia encabezados de la página - redirecciona a la pagina admin

header('Location: ../index.php?sec=admin_origen');