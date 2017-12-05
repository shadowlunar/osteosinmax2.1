<?php
// Iniciando el manejo de sesiones
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de contacto</title>

    <link rel="stylesheet" href="css/estilos2.css">
    <link rel="stylesheet" href="css/font-awesome.css">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/scrip.js"></script>
</head>
<body>

    <?php 
    // Comprueba la existencia de la clave
    if( isset($_SESSION['envio']) )  {
        //Si envio es TRUE
        if($_SESSION['envio'] == TRUE ) {
    ?>
    <div class="alert alert-ok">
        <div class="alert-head">
            Mensaje Recibido con Éxito
        </div>
        <div class="alert-body">
            Gracias por tus comentarios
        </div>
    </div>
    <?php
        }
        //Si envio es FALSE
        else {
    ?>
    <div class="alert alert-bad">
        <div class="alert-head">
            Error al Enviar
        </div>
        <div class="alert-body">
            <!-- Escribir el motivo del error -->
        </div>
    </div>
    <?php
        }
        // Eliminamos la clave 'envio',
        // sólo será utilizada una única vez
        unset($_SESSION['envio']);
    }
    ?>


    <section class="form_wrap">

        <section class="cantact_info">
            <section class="info_title">
                <span class="fa fa-user-circle"></span>
                <h2>OSTEO SIN MAX</h2>
            </section>
            <section class="info_items">
                <p><span class="fa fa-envelope"></span> darklucario2@gmail.com</p>
                <p><span class="fa fa-mobile"></span> +1(585) 902-8665</p>
            </section>
        </section>

        <form action="enviar.php" method="post" class="form_contact">
            <h2>¡Escríbenos! <small>Recibiremos tu mensaje.</small></h2>
            <div class="user_info">
                <label for="names">Nombre Completo *</label>
                <input type="text" id="names" name="nombre" required>

                <label for="phone">Teléfono / Celular</label>
                <input type="text" id="phone" name="telefono">

                <label for="email">Correo electrónico *</label>
                <input type="email" id="email" name="correo" required>

                <label for="mensaje">Mensaje *</label>
                <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

                <input type="submit" value="Enviar" id="btnSend">
            </div>
        </form>

    </section>

</body>
</html>
