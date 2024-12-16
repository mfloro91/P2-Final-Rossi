<?PHP

class Material
{
    private $id;
    private $nombre;
    private $descripcion;


    /**
     * Devuelve el listado completo de materiales en sistema
     */

    public static function lista_completa(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM materiales";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $listado = $PDOStatement->fetchAll();

        return $listado;
    }

    /**
     * Inserta un nuevo material en la bbdd
     *@param string $nombre
     *@param string $descripcion    
     */

    public static function insert(string $nombre, string $descripcion)
    {
        $conexion = (new Conexion())->getConexion();
        $query = "INSERT INTO materiales (`nombre`, `descripcion`)
        VALUES (:nombre, :descripcion)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'nombre' => $nombre,
                'descripcion' => $descripcion
            ]
        );
    }

    /**
     * Devuelve los datos de un material según su ID
     * @param int $id El ID de esa categoría
     */
    public static function get_x_id(int $id): ?Material
    {

        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM materiales WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);

        $resultado = $PDOStatement->fetch();

        return $resultado ? $resultado : null;
    }

    /**
     * Edita material en la bbdd
     *@param string $nombre
     *@param string $descripcion    
     */

    public function edit(string $nombre, string $descripcion)
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE materiales 
          SET nombre = :nombre, descripcion = :descripcion
          WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'id' => $this->id
            ]
        );
    }

    /**
     * Elimina esta instancia de la base de datos
     */
    public function delete()
    {
        $conexion = Conexion::getConexion();

        $query = "DELETE FROM materiales WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }

    /**
     * Devuelve el listado completo de materiales en sistema como array asociativo
     */

    public static function listado_completo(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM materiales";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();

        $listado = $PDOStatement->fetchAll();

        return $listado;
    }

    //GETTERS



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    //SETTERS

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
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}
