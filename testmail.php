<?php
require_once 'class/base_mail.php';
require_once 'class/phpmailer.php';

// Obtener el método de la solicitud de petición al servidor
$REQ_METHOD = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
$REQ_METHOD = strtolower(trim((string) $REQ_METHOD));

// Comprobar que la petición es originada por POST
if( $REQ_METHOD == 'post' ) {
    // Dump
    echo '<pre>';
    echo print_r($_POST, true);
    echo '</pre>';
    // Otra función para hacer dump
    //var_dump($_POST);

    # Obtener los datos
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : '';
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

    # Preparar el uso de la clase PHPMailer para trabajar con el envío de emails a nombre de otro servidor usando el protocolo SMTP
    $smtp = new PHPMailer();

    # Indicamos que vamos a utilizar un servidor SMTP
	$smtp->IsSMTP();
	
	# Definimos el formato del correo con UTF-8
    $smtp->CharSet="UTF-8";
    
    # Credenciales de Conexión
	$smtp->SMTPAuth   = true;
	$smtp->SMTPSecure = SECURITY_PROTOCOL;
	$smtp->Host       = HOST_MAIL;
	$smtp->Username   = NAME_MAIL;
	$smtp->Password   = PASS_MAIL;
	$smtp->Port       = PORT_MAIL;
    
    # Datos del Remitente
    # TODO: Cambiar por los parámetros a utilizar en el su servicio
	$smtp->From       = "tu_mail@mail.com";
    $smtp->FromName   = "Nombre del Remitente"; 
    
	# Indicamos los destinatarios usando el siguiente formato
	#   "correo" => "nombre usuario"
	$mailTo=array(
	    $correo => $nombre,
    );

    # Asunto del Mensaje
    $smtp->Subject = $asunto;

    ## NOTA: En un correo electrónico es importante establecer los tipos de contenido: 'Solo Texto Plano' o 'Texto Plano y HTML'
    
	# Indicamos el contenido de solo texto
    $smtp->AltBody = $mensaje;
    # Indicamos el contenido HTML
    $smtp->MsgHTML($mensaje);
    
    $i = 0;
    $item = [];
    # Iterar a cada correo 
    foreach($mailTo as $mail=>$name) {
	    $smtp->ClearAllRecipients();
	    $smtp->AddAddress($mail,$name);
    
        # Se envia y verifica el estatus
	    if( !( @$smtp->Send() ) )
	    {
	        $item[] = array('mail' => $mail, 'error_info' =>  $smtp->ErrorInfo);
        }
        else {
	    	++$i;
	    }
    }

    if( count($mailTo) == $i ) {
        echo '<h1>Enviado Correctamente</h1>';
    }
    else {
        echo '<h1>Erroral enviar a los siguientes correos</h1>';
        foreach($item as $key => $value) {
            echo $value['mail'] . ' : ' . $value['error_info'] . '<br>';
        }
    }
}
else {
    header('Location:index.php');
}