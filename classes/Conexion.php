<?PHP

/**
 * Clase conexión permite agilizar cada vez que usemos PDO
 */

class Conexion
{
    private const DB_SERVER = "localhost";
    private const DB_USER = "root";
    private const DB_PASS = "";
    private const DB_NAME = "vecchio";


    // Llave DSN permite conectar a MySQL

    private const DB_DSN = "mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";

    // Declaro variable $bbdd
    private static ?PDO $bbdd = null;

    // Hago constructor usando un try catch - si no logra conectar usando el PDO, tengo un catch

    public static function conectar()
    {
        try {
            self::$bbdd = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
        } catch (Exception $e) {
            die('Error al conectar con la base de datos');
        }
    }


    /**
     * Método que devuelve la conexión PDO
     * @return PDO
     */

    public static function getConexion(): PDO
    {
        if(self::$bbdd === null){
            self::conectar();
        }
        return self::$bbdd;
    }

}
