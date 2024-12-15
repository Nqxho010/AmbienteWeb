<?php
$titulo = 'Index Perfil';
require_once '../layout/head.php';
require_once '../layout/header.php';
require_once '../layout/footer.php';
?>
    <link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/Emprendedores.css">

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
            <input type="text" id="Emprendimiento" placeholder="Selecciona nombre del Producto:" required>
            <br>
            <label for="Categoria">Correo:</label>
            <input type="email" id="idcategoria" placeholder="Seleccionar Categoria del Producto:" required>
            <br>
            <label for="descripcion">Provincia:</label>
            <input type="text" id="salarioBruto" placeholder="Ingresa tu salario bruto" required>
            <br>
            <label for="precio">Direccion:</label>
            <input type="text" id="precio" placeholder="Ingresar Precio" required>
            <br>
            <button class="boton-verde" onclick="window.location.href='IndexEmp.php';">Agregar</button>
            <button class="boton-verde" onclick="window.location.href='IndexEmp.php';">Eliminar Perfil?</button>
            <button class="boton-verde" onclick="window.location.href='IndexEmp.php';">Cancelar</button>
            </form>
        </div>

        <br>

   
    
    <script src="js/menuUsuario.js"></script>
