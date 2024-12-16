<?PHP

require_once '../../functions/autoload.php';

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;

// Al procesar, llamo al metodo edit
// Agarro los inputs del form y edito la bbdd 
// Si algo sale mal, tengo el catch

try {

$material = Origen::get_x_id($id);

$material->edit(
    $postData['nombre'],
    $postData['descripcion']
);

Alerta::agregar_alerta('success', "El lugar de origen se editó correctamente");

} catch (Exception $e) {
    Alerta::agregar_alerta('danger', "Hubo un error y no se pudo editar la el lugar de origen. Para solucionarlo, contactate con el administrador del sistema");
}

// Funcion header de php cambia encabezados de la página - redirecciona a la pagina admin

header('Location: ../index.php?sec=admin_origen');