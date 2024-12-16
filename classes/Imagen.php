<?PHP

class Imagen
{

    /**
    * Sube una imagen y la mueve al directorio img 
    */

    public static function subirImagen($directorio, $datosArchivo): string
    {

        $nombre_original = explode(".", $datosArchivo['name']);
        $extension = end($nombre_original);
        $nuevo_nombre = time() . ".$extension";

        // Move lleva como parametros primero el nombre y luego el destino
        $fileUpload = move_uploaded_file($datosArchivo['tmp_name'], "$directorio/$nuevo_nombre");

        if (!$fileUpload) {
            throw new Exception("No se pudo subir la imagen");
        }else{
            return $nuevo_nombre;
        }
    }
    
    public static function borrarImagen($archivo): bool
    {

        if (file_exists(($archivo))) {


            $fileDelete =  unlink($archivo);

            if (!$fileDelete) {
                throw new Exception("No se pudo eliminar la imagen");
            } else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }
}
