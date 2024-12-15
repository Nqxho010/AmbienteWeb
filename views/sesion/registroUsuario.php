<?php 
    $titulo = 'Registro de Usuario';
    $accion = '/AmbienteWeb/controller/RegistroUsuarioController.php';
    $cancelar = "/AmbienteWeb/index.php";

    require_once '../layout/head.php';


    require_once '../../model/db.php'; 
    require_once '../../model/provincia.php';

    // Obtener las provincias desde el modelo
    $provinciaModel = new Provincia($conn);
    $provincias = $provinciaModel->obtenerProvincias();

    $mensajeError = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;
?>
<div class="imagen-fondo">
    <div class="login">
        <div class="login__logo">
            <div class="logo">
                <a href="#" class="logo__link">
                    <img src="/AmbienteWeb/public/img/logo.jpg" class="logo__imagen" alt="Logo">
                    <span>Feria Virtual CR</span>
                </a>
            </div>
        </div>

        <h2 class="login__titulo">Registro de Usuario</h2>

        <!-- Mostrar mensaje de error si existe -->
        <?php if ($mensajeError): ?>
            <div class="alerta alerta--error">
                <?= $mensajeError ?>
            </div>
        <?php endif; ?>

        <form action="<?= $accion ?>" method="POST">
            <div class="login__grupo-entrada">
                <label for="nombre" class="login__label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="login__input" required>
            </div>

            <div class="login__grupo-entrada">
                <label for="apellidos" class="login__label">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="login__input" required>
            </div>

            <div class="login__grupo-entrada">
                <label for="email" class="login__label">Correo Electrónico</label>
                <input type="email" id="email" name="correo" class="login__input" required autocomplete="email">
            </div>

            <div class="login__grupo-entrada">
                <label for="password" class="login__label">Contraseña</label>
                <input type="password" id="password" name="password" class="login__input" required>
            </div>

            <div class="login__grupo-entrada">
                <label for="provincia" class="login__label">Provincia</label>
                <select id="provincia" name="id_provincia" class="login__input" required>
                    <option value="">Seleccione una provincia</option>
                    <?php foreach ($provincias as $provincia): ?>
                        <option value="<?= $provincia['id_provincia'] ?>"><?= htmlspecialchars($provincia['detalle']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="login__grupo-entrada">
                <label for="direccion" class="login__label">Dirección</label>
                <input type="text" id="direccion" name="detalle_direccion" class="login__input" required>
            </div>

            <div class="login__cont-botones">
                <a class="boton-rojo" href="<?= $cancelar; ?>">Cancelar </a>
                <button type="submit" class="boton-verde">Registrar</button>
            </div>

            <hr>                
        </form>
    </div>
</div>
</html>
