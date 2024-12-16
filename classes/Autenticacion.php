<?PHP

class Autenticacion
{


    /**
     * Verifica las credenciales del usuario, y de ser correctas, guarda los datos en la sesión
     * @param string $nombreUsuario El nombre de usuario provisto
     * @param string $password La contraseña provista
     * @return mixed Devuelve el rol en caso que las credenciales sean correctas, FALSE en caso de que no lo sean y Null en caso que el usuario no se encuentre en la BDD
     */

    public static function logIn(string $nombreUsuario, string $password): mixed
    {
        $datosUsuario = Usuario::usuario_x_nombreUsuario($nombreUsuario);

        if ($datosUsuario) {

            //El usuario ingresado SI se encontró en nuestra base de datos

            if (password_verify($password, $datosUsuario->getpassword())) {

                echo "<p>EL PASSWORD ES CORRECTO! LOGUEAR!</p>";

                $datosLogin['nombre_usuario'] = $datosUsuario->getNombre_usuario();
                $datosLogin['nombre_completo'] = $datosUsuario->getNombre_completo();
                $datosLogin['id'] = $datosUsuario->getId();
                $datosLogin['rol'] = $datosUsuario->getRol();

                $_SESSION['usuarioLogueado'] = $datosLogin;

                return $datosLogin['rol'];
            
            } else {
                Alerta::agregar_alerta('danger', "El password que ingresaste no es correcto.");
                return FALSE;
            }
        } else {
            Alerta::agregar_alerta('warning', "El usuario que ingresaste NO se encontró en nuestra base de datos.");
            return NULL;
        }
    }



    /**
     * Cierra la sesión del usuario
     */

    public static function logOut()
    {

        if (isset($_SESSION['usuarioLogueado'])) {
            unset($_SESSION['usuarioLogueado']);
        };
    }

    /**
     * Verifica si la persona esta logueada y si ademas es admin
     */

    public static function verify($admin = TRUE): bool
    {

        if (isset($_SESSION['usuarioLogueado'])) {

            if ($admin) {

                if ($_SESSION['usuarioLogueado']['rol'] == "admin" or $_SESSION['usuarioLogueado']['rol'] == "superadmin") {
                    return TRUE;
                } else {
                    Alerta::agregar_alerta('danger', "Uuups! Chusma chusma pppp. No tienes acceso de admin.");
                    header('location: ../index.php?sec=login');
                }
            } else {
                return TRUE;
            }
        } else {
            header('location: index.php?sec=login');
        }
    }
}
