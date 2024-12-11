<?php
$menuHeader = [
    ["label" => "Inicio", "url" => "/AmbienteWeb/index.php"],
    ["label" => "Emprendedores", "url" => "/AmbienteWeb/views/usuarios/emprendedores.php"],
    ["label" => "Emprendedores", "url" => "/AmbienteWeb/views/usuarios/productos.php"]
];

$menuUsuario = [
    ["label" => "Iniciar sesión", "url" => "/AmbienteWeb/views/sesion/inicioSesion.php"],
    ["label" => "Mis Productos", "url" => "#"],
    ["label" => "Pedidos", "url" => "#"],
    ["label" => "Mi tienda", "url" => "/AmbienteWeb/views/emprendedores/adminPerfilEmprendedor.php"]
];
?>

<header class="header">
    <!-- Componente de logo -->
    <div class="logo">
        <a href="#" class="logo__link">
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
        <a href="#" class="user-menu__icon" id="userIcon">&#x1F464;</a>

        <div class="user-menu__dropdown" id="userDropdown">
            <?php 
            foreach($menuUsuario as $item){
                echo '<a class="user-menu__item" href="' . $item["url"] . '">' . $item["label"] . '</a>';
            }
            ?>            
        </div>
    </div>
</header>