<?PHP
class Carrito
{

    /**
     * Agrega un item al carrito de compras
     * @param int $productoID El ID del producto que se va a agregar.
     * @param int $cantidad La cantidad de unidades del producto que se van a agregar
     */

    public static function add_producto(int $productoID, int $cantidad)
    {
        $productoData = Producto::productoId($productoID);

        if ($productoData) {
            $_SESSION['carrito'][$productoID] = [
                'img' => $productoData->getImg(),
                'alt' => $productoData->getAlt(),
                'nombre' => $productoData->getNombre(),
                'categoria' => $productoData->getCategoria(),
                'lugar_origen' => $productoData->getLugar_origen(),
                'precio' => $productoData->getPrecio(),
                'cantidad' => $cantidad
            ];
        }
    }

    /**
     * Elimina un item del carrito de compras
     * @param int $productoID El id del producto a elminar
     */

    public static function remove_producto(int $productoID)
    {
        if (isset($_SESSION['carrito'][$productoID])) {
            unset($_SESSION['carrito'][$productoID]);
        }
    }

    /**
     * Vacía el carrito de compras
     */

    public static function clear_producto()
    {
        $_SESSION['carrito'] = [];
    }

    /**
     * Actualiza las cantidades de los ids provistos
     * @param array $cantidades Array asociativo con las cantidades de cada ID
     */
    
    public static function actualizar_cantidades(array $cantidades)
    {
        foreach ($cantidades as $key => $value) {
            if (isset($_SESSION['carrito'][$key])) {
                $_SESSION['carrito'][$key]['cantidad'] = $value;
            }
        }
    }

    /**
     * Devuelve el contenido del carrito de compras actual
     */
    
    public static function get_carrito(): array
    {
        if (!empty($_SESSION['carrito'])) {
            return $_SESSION['carrito'];
        } else {
            return [];
        }
    }


    /**
     * Devuelve el precio total actual del carrito de compras
     */
    
    public static function precio_total(): float
    {
        $total = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $productoCarrito) {
                $total += $productoCarrito['precio'] * $productoCarrito['cantidad'];
            }
        }
        return $total;
    }
}
