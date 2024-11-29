<?php
$titulo = 'Editar Perfil';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>

    <link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/editarPedidos.css">

        <br>

        <div class="flex-container">
            <form class="form">

            <label for="FotoPerfil">Foto de perfil:</label>
            <input type="image" id="fotoperfil" placeholder="Juan" required>
            <br>

            <label for="nombre">Nombre del Usuario:</label>
            <input type="text" id="nombre" placeholder="Juan" required>
            <br>
            <label for="nombre">Apellidos del Usuario:</label>
            <input type="text" id="apelli" placeholder="Cruz Navarro" required>
            <br>
            <label for="Categoria">Correo:</label>
            <input type="email" id="correo" placeholder="Juan38384@gmail.com" required>
            <br>
            <label for="Provincia">Provincia:</label>
            <input type="text" id="provincia" placeholder="San Jose" required>
            <br>
            <label for="precio">Direccion:</label>
            <input type="text" id="direccion" placeholder="100mts este ..." required>
            <br>
            <button class="boton-verde" type="submit">Guardar Cambios</button>
            <br>
            <button class="boton-rojo" type="submit">Cancelar</button>
            </form>
        </div>
        <br>

    <?php require_once '../layout/footer.php'; ?>
    
    <script src="js/menuUsuario.js"></script>