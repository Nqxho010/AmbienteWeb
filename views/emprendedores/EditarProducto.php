<?php
$titulo = 'Editar Producto';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>

<link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/editarPedidos.css">


    <h3> Mis productos > Editar</h3>

    <div class="flex-container">
        <form class="form">
            
            
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" placeholder="Ingresar nombre del Producto:" required>
            <br>
            <label for="nombre">Nombre del Emprendimiento:</label>
            <input type="text" id="Emprendimiento" placeholder="Selecciona nombre del Producto:" required>
            <br>
            <label for="Categoria">Categoria del Producto:</label>
            <input type="number" id="idcategoria" placeholder="Seleccionar Categoria del Producto:" required>
            <br>
            <label for="descripcion">Descripcion:</label>
            <input type="number" id="salarioBruto" placeholder="Ingresa tu salario bruto" required>
            <br>
            <label for="precio">Precio (₡):</label>
            <input type="number" id="precio" placeholder="Ingresar Precio" required>
            <br>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" placeholder="Ingresar Cantidad (Stock)" required>
            <br>
            <label for="img">Imagen:</label>
            <input type="image" id="img" placeholder="Insetar Imagen" >
            <br>
            <button class="boton-verde" onclick="window.location.href='IndexEmp.php';">Aceptar Cambios</button>
            <br>
            <button class="boton-verde" onclick="window.location.href='IndexEmp.php';">Eliminar</button>
            <br>
            <button class="boton-verde" onclick="window.location.href='IndexEmp.php';">Cancelar</button>
        </form>
    </div>

    <?php require_once '../layout/footer.php'; ?>
    
    <script src="js/menuUsuario.js"></script>
   