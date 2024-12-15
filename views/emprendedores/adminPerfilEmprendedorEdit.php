<?php
$titulo = 'Editar Perfil de Emprendedor';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>
<!-- ==================================================================== -->

<div class="perfil-emprendimiento">
    <div class="perfil-emprendimiento__grid">
        <img class="perfil-emprendimiento__img"
            src="https://answers-afd.microsoft.com/static/images/image-not-found.jpg" alt="Imagen emprendimiento">
        <div class="perfil-emprendimiento__group-info">
            <label for="nombre-emprendimiento" class="perfil-emprendimiento__label">Nombre
                emprendimiento</label>
            <input id="nombre-emprendimiento" class="perfil-emprendimiento__nombre" type="text"
                value="Nombre Emprendimiento">

            <label for="detalle-emprendimiento" class="perfil-emprendimiento__label">Detalle del
                emprendimiento</label>
            <textarea id="detalle-emprendimiento" class="perfil-emprendimiento__detalle"
                rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
        </div>

    </div>
    <div class="perfil-emprendimiento__boton">
        <button class="boton-verde">Guardar cambios</button>
    </div>
</div>

<?php
require_once '../layout/footer.php';
?>