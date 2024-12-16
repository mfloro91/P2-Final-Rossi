<?PHP

require_once '../../functions/autoload.php';

$postData = $_POST;


// Al procesar, llamo al metodo insert - clase material
// Agarro los inputs del form y agrego a la bbdd 
// Si algo sale mal, tengo el catch

try {

    Material::insert(
        $postData['nombre'],
        $postData['descripcion']
    );

    Alerta::agregar_alerta('success', "El material se agregó correctamente");

} catch (Exception $e) {
    Alerta::agregar_alerta('danger', "Hubo un error y no se pudo agregar el material. Para solucionarlo, contactate con el administrador del sistema");
}

// Funcion header de php cambia encabezados de la página - redirecciona a la pagina admin

header('Location: ../index.php?sec=admin_material');