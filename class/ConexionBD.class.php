<?php
/**
 * Filename: ConexionBD.class.php
 * Singleton que permite obtener una instancia de conexión a BD usando la clase PDO
 * 
 * @author Miguel Vázquez
 * Notas
 * Modificación realizada del ejemplo presentado en la página http://www.hermosaprogramacion.com/2015/05/crear-un-webservice-para-android-con-mysql-php-y-json/
 */


class ConexionBD
{	
	/**
	 * Unica instancia de la clase
	 */
	private static $db = null;

	/**
	 * Instancia de PDO
	 */
	private static $pdo;

	final private function __construct()
	{
		try {
			// Crear nueva conexion PDO
			self::obtenerBD();
		} catch (PDOException $e) {
			throw new Exception($e->getMessage(), $e->getCode(), $e);
		}
	}

	/**
	 * Retorna en la unica instancia de la clase
	 * @return ConexionBD|null
	 */
	public static function obtenerInstancia()
	{
		if (self::$db === null) {
			self::$db = new self();
		}
		return self::$db;
	}

	/**
	 * Crear una nueva conexion PDO basada
	 * en las constantes de conexion
	 * @return PDO Objeto PDO
	 */
	public function obtenerBD()
	{
		require 'base_db.php';	
		
		if (self::$pdo == null) {
			self::$pdo = new PDO(
					'mysql:dbname=' . $db_params[$def_conn]['DB_NAME'] .
					';host=' . $db_params[$def_conn]['DB_HOSTNAME'] . ";",
					$db_params[$def_conn]['DB_USERNAME'],
					$db_params[$def_conn]['DB_PASSWORD'],
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
					);

			// Habilitar excepciones
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		return self::$pdo;
	}

	/**
	 * Evita la clonacion del objeto
	 */
	final protected function __clone(){ }

	function _destructor(){ self::$pdo = null; }
}
?>
