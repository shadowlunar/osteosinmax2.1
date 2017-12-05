<?php
session_start();
// Obtener el método de la solicitud de petición al servidor
$REQ_METHOD = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
$REQ_METHOD = strtolower(trim((string) $REQ_METHOD));

// Comprobar que la petición es originada por POST
if( $REQ_METHOD == 'post' ) {

    // Comprobar la existencia de todos los campos necesarios
    if( isset( $_POST['nombre'] ) && 
        isset($_POST['correo']) && 
        isset( $_POST['telefono']) && 
        isset( $_POST['mensaje']) 
        ) {

        // Llamando a los campos
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $mensaje = $_POST['mensaje'];

        // TODO: Agregar aquí el almacenamiento de mensaje en DB

        // Datos para el correo
        $enviar_a = "darklucario2@gmail.com";
        $asunto = "Contacto desde nuestra web";

        $carta = "De: $nombre \n";
        $carta .= "Correo: $correo \n";
        $carta .= "Telefono: $telefono \n";
        $carta .= "Mensaje: $mensaje";

        // Enviando Mensaje
        $b = mail($enviar_a, $asunto, utf8_decode($carta));

        // Guardar el estatus del envío de email en sesión
        $_SESSION['envio'] = $b;
        
        // Comprobar que el mail se ha enviado
        if($b == TRUE) {
            // TODO: Enviar mensaje de Ok
        }
        else {
            // TODO: Enviar mensaje de error
        }

        // Confimar los cambios realizados en la sesión
        session_commit();

        // Reedireccionar
        header('Location: formulario.php');
    }
    else {
        die('Faltan Campos');
    }
}
else {
    header('Location:index.php');
}
?>