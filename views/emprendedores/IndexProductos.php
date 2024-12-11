<?php
$titulo = ' Producto Empleado';
require_once '../layout/head.php';
require_once '../layout/header.php';
require_once '../layout/footer.php';
?>
    <!--<link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/Emprendedores.css">-->

        <div>
            <h2>Lista de Productos</h2>
            <?php include '../../model/producto.php'; ?>

    
        </div>
    
    <script src="js/menuUsuario.js"></script>
  