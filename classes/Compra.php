<?PHP

class Compra
{

    private $id;
    private Usuario $usuario;
    private $fecha;
    private $importe;

     /**
     * Devuelve las compras de un usuario en particular
     * @param int $idUsuario El ID del usuario a mostrar
     */
    public static function compras_x_id_usuario(int $idUsuario): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT compras.id, compras.fecha, GROUP_CONCAT(CONCAT(producto_x_compra.cantidad, 'x ' ,productos.nombre) SEPARATOR ', ') detalle, compras.importe, productos.img, productos.alt FROM compras JOIN producto_x_compra ON compras.id = producto_x_compra.compra_id JOIN productos ON producto_x_compra.producto_id = productos.id WHERE compras.id_usuario = ? GROUP BY (compras.id);";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$idUsuario]);

        $result = $PDOStatement->fetchAll();

        return $result ?? [];
    }

    /**
     * Función que devuelve un listado de todas las compras
     * @return array Devuelve un array de compras realizadas
     */

     public static function listadoCompras(): array

     {
 
         //Traigo el método de la clase Conexion
         $conexion = Conexion::getConexion();
 
         // Hago un query que traiga datos de las compras
        $query = "SELECT compras.id, 
        compras.fecha, 
        compras.importe, 
        usuarios.nombre_completo, 
        usuarios.email, 
        GROUP_CONCAT(CONCAT(producto_x_compra.cantidad, 'x ' ,productos.nombre) SEPARATOR ', ') detalle 
        FROM compras 
        LEFT JOIN usuarios ON compras.id_usuario = usuarios.usuario_id 
        LEFT JOIN producto_x_compra ON compras.id = producto_x_compra.compra_id 
        LEFT JOIN productos ON producto_x_compra.producto_id = productos.id 
        GROUP BY compras.id";
 
         // Creo el PDO statement
 
         // Le paso la consulta $query al método prepare de mi conexión
         $PDOStatement = $conexion->prepare($query);
 
         // Estipulo el fetch mode
         $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
 
         // Ejecuto el statement
         $PDOStatement->execute();
 
         $listados = $PDOStatement->fetchAll();

         return $listados;
         
     }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of categoria
     */
    public function getUsuarioId()
    {
        return $this->usuario->getId();
    }

    /**
     * Get the id of categoria
     */
    public function getUsuario()
    {
        return $this->usuario->getNombre_completo();
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Get the value of importe
     */ 
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Set the value of importe
     *
     * @return  self
     */ 
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }
}