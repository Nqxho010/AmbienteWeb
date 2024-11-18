<?php 
    $titulo = 'Registro de Usuario';
    $accion = '/AmbienteWeb/controller/registroUsuario.php';
    $cancelar = "/AmbienteWeb/index.php";

    require_once '../layout/head.php';
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

            <h2 class="login__titulo">Registro de Usuario</h2>
            <form action="<?= $accion ?>" method="POST">

                <div class="login__grupo-entrada">
                    <label for="email" class="login__label">Correo electronico</label>
                    <input type="email" id="email" name="correo" class="login__input" required autocomplete="email">
                </div>

                <div class="login__grupo-entrada">
                    <label for="password" class="login__label">Contraseña</label>
                    <input type="password" id="password" name="password" class="login__input" required>
                </div>

                <div class="login__cont-botones">
                    <a class="boton-rojo" href="<?= $cancelar; ?>">Cancelar </a>
                    <button type="submit" class="boton-verde">Ingresar</button>
                </div>

                <hr>                
                
                
            </form>
        </div>
</div>
</html>