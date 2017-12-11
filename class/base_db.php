<?php
//nombre de la conexion por default
$def_conn = 'local';

//local
$db_params['local']=array(
    'DB_HOSTNAME' => 'localhost',
    'DB_NAME' =>'NOMBRE_DE_BASE_DE_DATOS',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '', 
);

//PRODUCION
$db_params[production] =array(
    'DB_HOSTNAME' => '',
    'DB_NAME' =>'',
    'DB_USERNAME' => '',
    'DB_PASSWORD' => '', 
)
?>