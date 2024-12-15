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
                src="/AmbienteWeb/public/img/E.png">
            <h3 class="emprendimiento__nombre">Pasteleria Dulce Masas Finas</h3>
            <p class="emprendimiento__desecripcion">[Esta es la ubicacion de la descripcion corta de del emprendimiento]</p>
            <button class="ingresar" onclick="window.location.href='/AmbienteWeb/views/usuarios/emprendedor1.php'">Ingresar</button>
        </div>

        <div class="emprendimiento">
            <img class="emprendimiento__img"
                src="/AmbienteWeb/public/img/joyeria.png">
            <h3 class="emprendimiento__nombre">La orchila Joyeria</h3>
            <p class="emprendimiento__desecripcion">[Esta es la ubicacion de la descripcion corta de del emprendimiento]</p>
            <button class="ingresar" onclick="window.location.href='/AmbienteWeb/views/usuarios/emprendedor2.php'">Ingresar</button>
        </div>

        <div class="emprendimiento">
            <img class="emprendimiento__img"
                src="/AmbienteWeb/public/img/Emprendimiento3.png">
            <h3 class="emprendimiento__nombre">Julia's Amiguromis</h3>
            <p class="emprendimiento__desecripcion">[Esta es la ubicacion de la descripcion corta de del emprendimiento]</p>
            <button class="ingresar" onclick="window.location.href='/AmbienteWeb/views/usuarios/emprendedor3.php'">Ingresar</button>
        </div>
    </div>
</div>

<style>
    .ingresar{
        background-color: var(--verde-oscuro); 
        color: var(--texto-claro);
        padding: 10px 20px; 
        border: none; 
        border-radius: var(--border-radius); 
        cursor: pointer; 
        font-weight: 700;
        transition: background-color 0.3s, transform 0.3s; /* Transición suave */ 
    }
</style>

<?php
require_once '../layout/footer.php';
?>