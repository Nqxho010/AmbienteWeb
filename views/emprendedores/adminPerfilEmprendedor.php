<?php
$titulo = 'Perfil de Emprendedor';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>
<!-- ==================================================================== -->

<div class="perfil-emprendimiento">
    <img class="perfil-emprendimiento__img"
        src="https://answers-afd.microsoft.com/static/images/image-not-found.jpg">
    <div class="perfil-emprendimiento__group-info">
        <h2 class="perfil-emprendimiento__nombre">[Nombre emprendimiento]</h2>
        <p class="perfil-emprendimiento__detalle">[Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
            deserunt mollit anim id est laborum]</p>
    </div>
    <div class="perfil-emprendimiento__boton">
        <button class="boton-verde">Modificar</button>
    </div>
</div>

<?php
require_once '../layout/footer.php';
?>