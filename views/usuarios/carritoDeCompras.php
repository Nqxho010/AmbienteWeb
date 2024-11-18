<?php
$titulo = ' Emprendedor 1';
require_once '../layout/header.php';
require_once '../layout/footer.php';
require_once "/AmbienteWeb/public/css/carritoDeCompras.css";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen del Carrito</title>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <!-- Componente de logo -->
        <div class="logo">
            <a href="#" class="logo__link">
                <img src="Img/Logo.JPG" class="logo__imagen" alt="Logo">
                <span>Feria Virtual CR</span>
            </a>
        </div>

        <!-- Componente de navegación -->
        <nav class="navbar">
            <ul class="navbar__list">
                <li><a href="#" class="navbar__link">Inicio</a></li>
                <li><a href="#" class="navbar__link">Emprendedores</a></li>
                <li><a href="#" class="navbar__link">Productos</a></li>
            </ul>
        </nav>

        <!-- Componente de iconos -->
        <div class="user-menu">
            <a href="#" class="user-menu__icon" id="userIcon">&#x1F464;</a>
            <div class="user-menu__dropdown" id="userDropdown">
                <a href="#" class="user-menu__item">Iniciar sesión</a>
            </div>
        </div>
    </header>

    <h1 class="carritoTxt">Resumen del Carrito</h1>
    <div class="cart-display">
        <!-- Los productos y el total se cargarán aquí -->
    </div>
    <button class="eliminar-btn">Eliminar</button>
    <button class="pagar-btn" onclick="window.location.href='checkout.php'">Prodceder con el pago</button>
    <script src="/Jose/js/carritoDeCompras.js"></script>

    
    <?php include
     require_once '../layout/footer.php';?>
</body>

</html>
