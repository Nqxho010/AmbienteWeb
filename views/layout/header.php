<?php
$menuHeader = [
    ["label" => "Inicio", "url" => "/AmbienteWeb/index.php"],
    ["label" => "Emprendedores", "url" => "/AmbienteWeb/views/usuarios/emprendimientos.php"],
    ["label" => "Productos", "url" => "/AmbienteWeb/views/usuarios/productos.php"]
];

$menuUsuario = [
    ["label" => "Iniciar sesión", "url" => "/AmbienteWeb/views/sesion/inicioSesion.php"],
    ["label" => "Mis Productos", "url" => "#"],
    ["label" => "Pedidos", "url" => "#"],
    ["label" => "Mi tienda", "url" => "/AmbienteWeb/views/emprendedores/adminPerfilEmprendedor.php"]
];


session_start();
$nombreUsuario = $_SESSION['nombreUsuario'] ?? null;

?>

<header class="header">
    <!-- Componente de logo -->
    <div class="logo">
        <a href="/AmbienteWeb/index.php" class="logo__link">
            <img src="/AmbienteWeb/public/img/logo.jpg" class="logo__imagen" alt="Logo">
            <span>Feria Virtual CR</span>
        </a>
    </div>

    <!-- Componente de navegación -->
    <nav class="navbar">
        <ul class="navbar__list">
            <?php
            foreach ($menuHeader as $item) {
                echo '<li><a href="' . $item["url"] . '" class="navbar__link">' . $item["label"] . '</a></li>';
            }
            ?>
        </ul>
    </nav>
    
    <!-- Componente de iconos -->
    <div class="user-menu">

        <?php if ($nombreUsuario): ?>
                <span class="user-menu__name">Hola, <?php echo htmlspecialchars($nombreUsuario); ?></span>
         <?php endif; ?>

        <a href="#" class="user-menu__icon" id="userIcon">&#x1F464;</a>

        <div class="user-menu__dropdown" id="userDropdown">
            <?php if (!$nombreUsuario): ?>
                <!-- NO LOGUEADO -->
                <a class="user-menu__item" href="/AmbienteWeb/views/sesion/inicioSesion.php">Iniciar sesión</a>
            <?php else: ?>
                <!-- LOGUEADO -->
                <?php if ($nombreUsuario): ?>
                    <a class="user-menu__item" href="/AmbienteWeb/views/usuarios/perfilUsuario.php">Perfil</a>
                    <a class="user-menu__item" href="/AmbienteWeb/views/usuarios/carritoUsuario.php">Carrito</a>
                    <a class="user-menu__item" href="/AmbienteWeb/views/usuarios/historialUsuario.php">Historial</a>
                    <a class="user-menu__item" href="/AmbienteWeb/views/sesion/editarPerfil.php">Editar Perfil</a>
                    <a class="user-menu__item" href="/AmbienteWeb/views/emprendedores/detallesPerfilUser.php">Ver Perfil</a>                  


                <?php endif; ?>  
                <hr>
                <?php if ($_SESSION['idTipoUsuario'] == 2): ?>                    
                    <a class="user-menu__item" href="/AmbienteWeb/views/emprendedores/adminPerfilEmprendedor.php">Mi tienda</a>
                    <a class="user-menu__item" href="/AmbienteWeb/views/emprendedores/misPedidos.php">Mis pedidos</a>
                    <a class="user-menu__item" href="/AmbienteWeb/views/emprendedores/misProductos.php">Mis productos</a> 
                    <a class="user-menu__item" href="/AmbienteWeb/views/sesion/editarPerfil.php">Editar Perfil</a>
                    <a class="user-menu__item" href="/AmbienteWeb/views/emprendedores/detallesPerfilEmp.php">Ver Perfil</a>                  
                    <?php endif; ?>                
                <a class="user-menu__item" href="/AmbienteWeb/controller/cerrarSesion.php">Cerrar sesión</a>
            <?php endif; ?>
        </div>
    </div>
</header>
