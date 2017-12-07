<?php
/**
 * Filename: autoload.php
 * Se encarga de inicializar todo lo necesario para trabajar con el entorno del microframework
 */
# Requires
require_once 'ConexionBD.class.php';

// Instancia PDO para la conexión a BD
$pdo = NULL;

try
{
    $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
}
catch(PDOException $pdoex)
{
    echo '<h1>No se puede conectar con la BD</h1><br>';
    die($ex->getCode() . ' | ' . $ex->getMessage() );
}
catch(Exception $ex)
{
    echo '<h1>Ocurrió un error</h1><br>';
    die($ex->getCode() . ' | ' . $ex->getMessage() );
}

if($pdo === NULL) {
    die('No se puede conectar a la BD');
}
