<?PHP

class Alerta

{

    /**
     * Registra alerta en el sistema, guardando en sesión
     * @param string $tipo es el tipo de alerta 
     * @param string $mensaje es el contenido texto de la alerta
     */

    public static function agregar_alerta(string $tipo, string $mensaje)
    {

        $_SESSION['alertas'][] = [
            'tipo' => $tipo,
            'mensaje' => $mensaje
        ];
    }

    /**
     * Vacía las alertas
     * */

    public static function limpiar_alertas()
    {

        $_SESSION['alertas'] = [];
    }

    /**
     * Imprime el codigo HTML de la alerta
     * * @return string devuelve un string con el codigo html para las alertas
     */

     private static function imprimir_alerta($alerta): string {
        
        $html = "<div class='alert alert-{$alerta['tipo']} alert-dismissible fade show' role='alert'>";
        $html .= $alerta['mensaje'];
        $html .= "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        $html .= "</div>";

        return $html;
     }

     

    /**
     * Devuelve todas las alertas acumuladas en el sistema y vacía la lista
     
     */

    public static function get_alertas()
    {

        if (!empty($_SESSION['alertas'])) {

            $alertasActuales = "";

            foreach ($_SESSION['alertas'] as $alerta) {
                $alertasActuales .= self::imprimir_alerta($alerta);
            }

            self::limpiar_alertas();
            return $alertasActuales;

        } else {
            return null;
        }
    }
}
