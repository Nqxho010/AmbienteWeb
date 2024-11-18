<?php
$titulo = 'Emprendimientos';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>
<!-- ============================================================= -->
<div class="main-cont">

    <select class="main-cont__dropdown">
        <option value="" disabled selected>Elija una categoría...</option>
        <option value="opcion1">Opción 1</option>
        <option value="opcion2">Opción 2</option>
        <option value="opcion3">Opción 3</option>
    </select>


    <div class="main-cont__emprendimientos">

        <div class="emprendimiento">
            <img class="emprendimiento__img"
                src="https://answers-afd.microsoft.com/static/images/image-not-found.jpg">
            <h3 class="emprendimiento__nombre">[Nombre emprendimiento]</h3>
            <p class="emprendimiento__desecripcion">[Esta es la ubicacion de la descripcion corta de del emprendimiento]</p>
        </div>

        <div class="emprendimiento">
            <img class="emprendimiento__img"
                src="https://answers-afd.microsoft.com/static/images/image-not-found.jpg">
            <h3 class="emprendimiento__nombre">[Nombre emprendimiento]</h3>
            <p class="emprendimiento__desecripcion">[Esta es la ubicacion de la descripcion corta de del emprendimiento]</p>
        </div>

        <div class="emprendimiento">
            <img class="emprendimiento__img"
                src="https://answers-afd.microsoft.com/static/images/image-not-found.jpg">
            <h3 class="emprendimiento__nombre">[Nombre emprendimiento]</h3>
            <p class="emprendimiento__desecripcion">[Esta es la ubicacion de la descripcion corta de del emprendimiento]</p>
        </div>

    </div>
</div>

<?php
require_once '../layout/footer.php';
?>