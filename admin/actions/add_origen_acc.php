<?PHP

require_once '../../functions/autoload.php';


$postData = $_POST;


// Al procesar, llamo al metodo insert - clase objeto
// Agarro los inputs del form y agrego a la bbdd nombre y descripcion del nuevo origen
// Si algo sale mal, tengo el catch

try {

    Origen::insert(
        $postData['nombre'],
        $postData['descripcion']
    );
    
    Alerta::agregar_alerta('success', "El lugar de origen se agregó correctamente");

} catch (Exception $e) {
    Alerta::agregar_alerta('danger', "Hubo un error y no se pudo agregar el lugar de origen. Para solucionarlo, contactate con el administrador del sistema");
}

// Funcion header de php cambia encabezados de la página - redirecciona a la pagina admin

header('Location: ../index.php?sec=admin_origen');