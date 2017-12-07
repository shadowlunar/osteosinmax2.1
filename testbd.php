<?php
require 'class/autoload.php';
// $pdo : Instancia para realizar las consultas sql a la DB

// Variables que ocuparemos más tarde
$arrayFechas = array();

# 1. Encapsular las operaciones en un try-catch tomando el siguiente ejemplo base
try
{
    # 2. Crear el query sql
    /*
    Este query significa: 

    Selecciona 
        Obten la 'fecha actual' y devuelve el resultado en una columna llamada 'HOY', 
        Suma 'un día' a la 'fecha actual' y devuelve el resultado en la columna 'MAÑANA'
    */
    $sql = "SELECT NOW() AS HOY, DATE_ADD(NOW(), INTERVAL 1 DAY) AS MAÑANA";

    # 3. Realizar la consulta a BD
    $statement = $pdo->query($sql);

    // Dump
    echo '<pre>';
    echo print_r($statement, true);
    echo '</pre>';
    // Otra función para hacer dump
    //var_dump($statement);

    # 4. Verificar que el objeto PDOStatement es válido
    if(!$statement) {
        throw new Exception('Error al realizar el query.', 1);
    }
    else {

        # 5 Obtener 
        $result_set = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result_set as $key => $value) {
            // Dump
            echo '<pre>';
            echo print_r($value, true);
            echo '</pre>';

            // Otra función para hacer dump
            //var_dump($value);
        }

        $arrayFechas = $result_set;
    }
}
catch(PDOException $pdoex)
{
    echo '<div style="margin: 2%; border: 1px solid red; padding: 2%;">';
    echo '<h2 style="color: red;">PDOException</h2>';
    echo '<dl>
        <dt style="font-weight: bold;">Code</dt>
        <dd>'. $pdoex->getCode() .'</dd>
        <dt style="font-weight: bold;">Filename</dt>
        <dd>'. $pdoex->getFile() .'</dd>
        <dt style="font-weight: bold;">Line</dt>
        <dd>'. $pdoex->getLine() .'</dd>
        <dt style="font-weight: bold;">Message</dt>
        <dd>'. $pdoex->getMessage() .'</dd>
    </dl>';
    echo '</div>';

    die();
}
catch(Exception $ex)
{
    echo '<div style="margin: 2%; border: 1px solid red; padding: 2%;">';
    echo '<h2 style="color: red;">Exception</h2>';
    echo '<dl>
        <dt style="font-weight: bold;">Code</dt>
        <dd>'. $ex->getCode() .'</dd>
        <dt style="font-weight: bold;">Filename</dt>
        <dd>'. $ex->getFile() .'</dd>
        <dt style="font-weight: bold;">Line</dt>
        <dd>'. $ex->getLine() .'</dd>
        <dt style="font-weight: bold;">Message</dt>
        <dd>'. $ex->getMessage() .'</dd>
    </dl>';
    echo '</div>';

    die();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejemplo de BD usando PDO</title>
</head>
<body>
    <hr>

    <?php
    /*
        Estilo 1 : En este ejemplo se encapsula toda la actividad de del ciclo
        y para desplegar a pantalla usamos la función 'echo' haciendo una concatenación de cadenas
    */
    ?>

    <?php
    foreach ($arrayFechas as $key => $value) {
        echo '<h1>La fecha de hoy es: </h1>' . $value['HOY'];
    }
    ?>


    <hr>


    <?php
    /*
        Estilo 2 : En este ejemplo se puede obsevar que existen más tags de php,
        pero permite tener el control directo sobre los tags de html si estar realizando concatenaciones de cadenas.
        Su control puede parecer difil pero con práctica es posible llevar este estilo
    */
    ?>
    <?php
    foreach ($arrayFechas as $key => $value) {
    ?>
    <h1>La fecha de hoy es: </h1><?php echo $value['HOY']; ?>
    <?php
    }
    ?>


</body>
</html>