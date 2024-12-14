<?php 
    $titulo = 'Inicio de Sesion';
    $accion = '/AmbienteWeb/controller/inicioSesionController.php';
    $cancelar = "/AmbienteWeb/index.php";
    $registrarse = "/AmbienteWeb/views/sesion/registroUsuario.php";

    require_once '../layout/head.php';

    $mensajeSucces = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : null;
    $mensajeError = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;
?>

<div class="imagen-fondo">

        <div class="login">
            <div class="login__logo">
                <!-- reutilizamos el logo del header -->
                <div class="logo">
                    <a href="#" class="logo__link">
                        <img src="/AmbienteWeb/public/img/logo.jpg" class="logo__imagen" alt="Logo">
                        <span>Feria Virtual CR</span>
                    </a>
                </div>

            </div>

            <h2 class="login__titulo">Inicio de sesion</h2>

            <?php if ($mensajeError): ?>
                <div class="alerta alerta--error">
                    <?= $mensajeError ?>
                </div>
            <?php endif; ?>

            <?php if ($mensajeSucces): ?>
                <div class="alerta">
                    <p><?= $mensajeSucces ?></p>
                </div>
            <?php endif; ?>

            <form action="<?= $accion ?>" method="POST">

                <div class="login__grupo-entrada">
                    <label for="email" class="login__label">Correo electronico</label>
                    <input type="email" id="email" class="login__input" name="correo" required autocomplete="email">
                </div>

                <div class="login__grupo-entrada">
                    <label for="password" class="login__label">Contraseña</label>
                    <input type="password" name="password" id="password" class="login__input" required>
                </div>

                <div class="login__cont-botones">
                    <a class="boton-rojo" href="<?= $cancelar; ?>">Cancelar </a>
                    <button type="submit" class="boton-verde">Ingresar</button>
                </div>

                <hr>                
                <div class="login__cont-registro">
                    <p class="login__mensaje-registro">Aun no tienes una cuenta? 
                        <a href="<?= $registrarse ?>" class="login__registrarse">Regístrate aquí</a> </p>
                </div>
            </form>
        </div>

</div>

</html>