<?PHP

class Producto
{
    private int $id;
    private Categoria $categoria;
    private string $nombre;
    private string $descripcion;
    private float $precio;
    private int $fecha_origen;
    private Origen $lugar_origen;
    private int $stock;
    private string $img;
    private string $alt;
    private array $materiales;

    private static $creaValores = ['id', 'nombre', 'descripcion', 'precio', 'fecha_origen', 'stock', 'img', 'alt'];

    /**
     * Devuelve una instancia del objeto Producto (Antigüedad), con todas sus propiedades configuradas
     *@return Producto
     */

    private static function creaProducto($productoData): Producto
    {

        //echo "<pre>";
        //print_r($productoData);
        //echo "</pre>";

        // Nueva instancia del producto
        $producto = new self();

        // Por cada valor que viene de la bbdd lo paso al objeto
        foreach (self::$creaValores as $valor) {
            $producto->{$valor} = $productoData[$valor];
        }

        // Agrego objeto categoria
        $producto->categoria = Categoria::get_x_id($productoData['categoria_id']);

        // Agrego objeto origen
        $producto->lugar_origen = Origen::get_x_id($productoData['lugar_origen_id']);

        // Materiales
        $materialesId =
            !empty($productoData['materiales']) ?
            explode(",", $productoData['materiales']) : [];

        $materiales = [];
        foreach ($materialesId as $MId) {
            $materiales[] = Material::get_x_id($MId);
        }

        $producto->materiales = $materiales;

        //echo "<pre>";
        //print_r($producto);
        // echo "</pre>";


        return $producto;
    }

    /**
     * Función que devuelve el catálogo entero 
     * @return array Devuelve un array de objetos Productos / Antigüedadades
     */

    public static function catalogoCompleto(): array

    {

        //Traigo el método de la clase Conexion
        $conexion = Conexion::getConexion();

        // Hago un query que traiga datos de mis productos
        $query = "SELECT 
        productos.*, 
        GROUP_CONCAT(producto_x_material.material_id) AS materiales 
        FROM productos
        LEFT JOIN producto_x_material AS producto_x_material ON productos.id = producto_x_material.producto_id   
        GROUP BY productos.id";

        // Creo el PDO statement

        // Le paso la consulta $query al método prepare de mi conexión
        $PDOStatement = $conexion->prepare($query);

        // Estipulo el fetch mode
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);

        // Ejecuto el statement
        $PDOStatement->execute();

        //Guardo en catalogo completo el array
        while ($result = $PDOStatement->fetch()) {
            $catalogoCompleto[] = self::creaProducto($result);
        }

        //Retorno el catalogo completo

        return $catalogoCompleto;
    }


    /**
     * Función que devuelve el catálogo de productos según la categoría
     * @param string $categoria Un string con el nombre de la categoría a filtrar
     * @return array retorna un array de productos
     */

    public static function catalogoFiltrado($categoria_id): array
    {

        $conexion = Conexion::getConexion();
        $catalogoFiltrado = [];

        $query = "SELECT 
        productos.*, 
        GROUP_CONCAT(producto_x_material.material_id) AS materiales 
        FROM productos
        LEFT JOIN producto_x_material AS producto_x_material ON productos.id = producto_x_material.producto_id 
        WHERE categoria_id = ?  
        GROUP BY productos.id";

        // Creo el PDO statement

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$categoria_id]);

        //Guardo en catalogo completo el array
        while ($result = $PDOStatement->fetch()) {
            $catalogoFiltrado[] = self::creaProducto($result);
        }

        return $catalogoFiltrado;
    }


    /**
     * Función que filtra por ID de producto
     * @param int $id del producto que voy a mostrar en la pagina del detalle del producto
     * @return ?Producto retorna un objeto Producto, o null si no lo encuentra
     */

    public static function productoId(int $id): ?Producto
    {

        $conexion = Conexion::getConexion();

        $query = "SELECT 
        productos.*, 
        GROUP_CONCAT(producto_x_material.material_id) AS materiales 
        FROM productos
        LEFT JOIN producto_x_material AS producto_x_material ON productos.id = producto_x_material.producto_id 
        WHERE productos.id = ?  
        GROUP BY productos.id";


        // Creo el PDO statement

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$id]);

        $catalogoPorID = self::creaProducto($PDOStatement->fetch());

        return $catalogoPorID != false ? $catalogoPorID : null;
    }


    /**
     * Función que filtra por año de origen / edad del producto
     * @param int $edad del producto que voy a mostrar 
     * @return array retorna un array de productos 
     */

    public static function filtroAntiguedad(int $edad): array
    {

        $conexion = Conexion::getConexion();
        $catalogoFiltrado = [];

        $query = "SELECT 
        productos.*, 
        GROUP_CONCAT(producto_x_material.material_id) AS materiales 
        FROM productos
        LEFT JOIN producto_x_material AS producto_x_material ON productos.id = producto_x_material.producto_id 
        WHERE fecha_origen between ? AND ?
        GROUP BY productos.id";

        // Creo el PDO statement

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$edad, $edad + 9]);

        //Guardo en catalogo completo el array
        while ($result = $PDOStatement->fetch()) {
            $catalogoFiltrado[] = self::creaProducto($result);
        }

        return $catalogoFiltrado;
    }

    /**
     * Función que filtra por precio
     * @param int $precio del producto que voy a mostrar 
     * @return array retorna un array de productos 
     */

    public static function filtroPrecio(int $precio): array
    {

        $conexion = Conexion::getConexion();
        $catalogoFiltrado = [];

        if ($precio == "150000") {

            $query = "SELECT 
            productos.*, 
            GROUP_CONCAT(producto_x_material.material_id) AS materiales 
            FROM productos
            LEFT JOIN producto_x_material AS producto_x_material ON productos.id = producto_x_material.producto_id 
            WHERE precio > ? 
            GROUP BY productos.id";

            // Creo el PDO statement

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $PDOStatement->execute([$precio]);
        } else {

            $query = "SELECT 
            productos.*, 
            GROUP_CONCAT(producto_x_material.material_id) AS materiales 
            FROM productos
            LEFT JOIN producto_x_material AS producto_x_material ON productos.id = producto_x_material.producto_id 
            WHERE precio between ? AND ? 
            GROUP BY productos.id";


            // Creo el PDO statement

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $PDOStatement->execute([$precio, $precio + 50000]);
        }

        //Guardo en catalogo completo el array
        while ($result = $PDOStatement->fetch()) {
            $catalogoFiltrado[] = self::creaProducto($result);
        }

        return $catalogoFiltrado;
    }


    /**
     * Función que filtra por materiales
     * @param string $material del producto que voy a mostrar 
     * @return array retorna un array de productos 
     */

    public static function filtroMateriales(string $material): array
    {

        $conexion = Conexion::getConexion();
        $catalogoFiltrado = [];

        $query = "SELECT 
        productos.*, 
        materiales.nombre AS material
        FROM productos 
        LEFT JOIN producto_x_material ON productos.id = producto_x_material.producto_id
        LEFT JOIN materiales ON producto_x_material.material_id = materiales.id
        WHERE materiales.nombre = ?
        GROUP BY productos.id;";

        // Creo el PDO statement

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$material]);

        //Guardo en catalogo completo el array
        while ($result = $PDOStatement->fetch()) {
            $catalogoFiltrado[] = self::creaProducto($result);
        }

        return $catalogoFiltrado;
    }




    /**
     * Función que devuelve el catálogo según el filtro seleccionado (categoria, origenes).
     * @param string $tipoFiltro es un string donde seleccionamos el tipo de filtro, $valorFiltro es el valor que le damos a la búsqueda.
     * @return array Devuelve un array con todos los objetos filtrados según el criterio seleccionado.
     */

    public static function catalogoFiltradoAEleccion(string $tipoFiltro, string $valorFiltro): array
    {
        $catalogo = self::catalogoCompleto();
        $resultado = [];

        foreach ($catalogo as $producto) {

            if ($producto->$tipoFiltro->getId() == $valorFiltro) {
                $resultado[] = $producto;
            }
        }

        return $resultado;
    }

    /**
     * Función que devuelve el catálogo de productos según la palabra ingresada en el buscador
     * @param string $palabra Un string ingresado por el usuario en el buscador
     * @return array retorna un array de productos
     */

    public static function buscador($palabra): array
    {

        $conexion = Conexion::getConexion();
        $catalogoFiltrado = [];

        $query = "SELECT 
         productos.*, 
         GROUP_CONCAT(producto_x_material.material_id) AS materiales 
         FROM productos
         LEFT JOIN producto_x_material AS producto_x_material ON productos.id = producto_x_material.producto_id 
         WHERE descripcion OR nombre LIKE ?
         GROUP BY productos.id";

        // Creo el PDO statement

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute(['%' . $palabra . '%']);

        //Guardo en catalogo completo el array
        while ($result = $PDOStatement->fetch()) {
            $catalogoFiltrado[] = self::creaProducto($result);
        }

        return $catalogoFiltrado;
    }


    /**
     * Devuelve el listado completo de categorias en sistema como array asociativo
     */

    public static function listado_completo(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM categoria";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();

        $listado = $PDOStatement->fetchAll();

        return $listado;
    }


    /**
     * Inserta un nuevo producto a la base de datos
     * @param int $categoria
     * @param string $nombre
     * @param string $descripcion
     * @param float $precio
     * @param string $fecha_origen El año de fabricación
     * @param int $lugar_origen
     * @param int $stock
     * @param string $img ruta a un archivo .jpg o .png 
     * @param string $alt Descripción de la imagen para accesibilidad
     */
    public static function insert($categoria, $nombre, $descripcion, $precio, $fecha_origen, $lugar_origen, $stock, $img, $alt)

    {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO productos VALUES (NULL, :categoria, :nombre, :descripcion, :precio, :fecha_origen, :lugar_origen, :stock, :img, :alt)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'categoria' => $categoria,
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'fecha_origen' => $fecha_origen,
                'lugar_origen' => $lugar_origen,
                'stock' => $stock,
                'img' => $img,
                'alt' => $alt,
            ]
        );

        return $conexion->lastInsertId();
    }


    /**
     * Edita el producto en la base de datos
     */
    public function edit($categoria, $nombre, $descripcion, $precio, $fecha_origen, $lugar_origen, $stock, $img, $alt)

    {

        $conexion = Conexion::getConexion();
        $query = "UPDATE productos SET
        categoria_id = :categoria_id,
        nombre = :nombre, 
        descripcion = :descripcion, 
        precio = :precio, 
        fecha_origen = :fecha_origen, 
        lugar_origen_id = :lugar_origen_id, 
        stock = :stock, 
        img = :img, 
        alt = :alt
        WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'categoria_id' => $categoria,
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'fecha_origen' => $fecha_origen,
                'lugar_origen_id' => $lugar_origen,
                'stock' => $stock,
                'img' => $img,
                'alt' => $alt,
            ]
        );
    }

    /**
     * Elimina esta instancia de la base de datos
     */
    public function delete()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM productos WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }

    /**
     * Crea un vinculo entre un producto y un material
     * @param int $producto_id
     * @param int $material_id
     */

    public static function add_materiales(int $producto_id, int $material_id)
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO producto_x_material VALUES (NULL, :producto_id, :material_id)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'producto_id' => $producto_id,
                'material_id' => $material_id
            ]
        );
    }

    /**
     * Vaciar lista de materiales
     */
    public function limpiar_materiales()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE 
        FROM producto_x_material WHERE producto_id = :producto_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'producto_id' => $this->id
            ]
        );
    }


    // GETTERS


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
    public function getCategoria()
    {
        return $this->categoria->getNombre();
    }

    /**
     * Get the id of categoria
     */
    public function getCategoriaId()
    {
        return $this->categoria->getId();
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

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Get the value of fecha_origen
     */
    public function getFecha_origen()
    {
        return $this->fecha_origen;
    }

    /**
     * Get the value of lugar_origen
     */
    public function getLugar_origen()
    {
        return $this->lugar_origen->getNombre();
    }

    /**
     * Get the id of lugar_origen
     */
    public function getLugar_origenId()
    {
        return $this->lugar_origen->getId();
    }


    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Get the value of img
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Get the value of alt
     */
    public function getAlt()
    {
        return $this->alt;
    }


    // SETTERS

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
     * Set the value of categoria_id
     *
     * @return  self
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

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

    /**
     * Set the value of precio
     *
     * @return  self
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Set the value of fecha_origen
     *
     * @return  self
     */
    public function setFecha_origen($fecha_origen)
    {
        $this->fecha_origen = $fecha_origen;

        return $this;
    }

    /**
     * Set the value of lugar_origen
     *
     * @return  self
     */
    public function setLugar_origen($lugar_origen)
    {
        $this->lugar_origen = $lugar_origen;

        return $this;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Set the value of alt
     *
     * @return  self
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get the value of materiales
     */
    public function getMateriales()
    {
        return $this->materiales;
    }

    /**
     * Set the value of materiales
     *
     * @return  self
     */
    public function setMateriales($materiales)
    {
        $this->materiales = $materiales;

        return $this;
    }
}
