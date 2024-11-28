<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Emprendedores</title>

    
</head>

<body>

    <header class="header">

        <div class="logo">
            <a href="#" class="logo__link">
                <img src="logo.JPG" class="logo__imagen" alt="Logo">
                <span>Feria Virtual CR</span>
            </a>
        </div>

        <nav class="navbar">
            <ul class="navbar__list">
                <li ><a href="#" class="navbar__link">Inicio</a></li>
                <li ><a href="#" class="navbar__link">Emprendedores</a></li>
                <li ><a href="#" class="navbar__link">Productos</a></li>
                <li ><a href="#" class="navbar__link">Ventas</a></li>
                <li ><a href="#" class="navbar__link">Pedidos</a></li>


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
            <button class="boton-verde" type="submit">Editar</button>
            <br>
            <button class="boton-rojo" type="submit">Eliminar Perfil</button>
            </form>
        </div>

        <br>

   
    
    <script src="js/menuUsuario.js"></script>
    <footer class="footer">
        <div>
            <p class="footer__derechos">&copy; 2024 Feria Virtual CR. Todos los derechos reservados.</p>            
        </div>
    </footer>
</body>

</html>