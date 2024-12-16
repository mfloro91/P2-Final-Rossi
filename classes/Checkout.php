<?PHP
class Checkout
{

    /**
     * Inserta los datos de una compra en la BBDD
     * @param array $datosCompra Array con los datos de la compra
     * @param array $detalleCompra Array con los productos incluidos en la compra
     */
     public static function insert_checkout_data(array $datosCompra, array $detalleCompra)
     {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO compras VALUES (NULL, :id_usuario, :fecha, :importe)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "id_usuario" => $datosCompra['id_usuario'], 
            "fecha" => $datosCompra['fecha'], 
            "importe" => $datosCompra['importe']
        ]);

        $isertedID = $conexion->lastInsertId();

        foreach ($detalleCompra as $key => $value) {
            $query = "INSERT INTO producto_x_compra VALUES (NULL, :compra_id, :producto_id, :cantidad)";
        
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                "compra_id" => $isertedID, 
                "producto_id" => $key, 
                "cantidad" => $value
            ]);
        }
     }

}