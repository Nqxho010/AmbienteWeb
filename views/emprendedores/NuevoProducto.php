<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>ProductosEmp</title>

    
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

        <div class="user-menu">            
            <a href="#" class="user-menu__icon" id="userIcon">&#x1F464;</a>

            <div class="user-menu__dropdown" id="userDropdown">
                <a href="#" class="user-menu__item">Iniciar sesión</a>
            </div>
        </div>
    </header>
    <h3> Mis productos > Nuevo</h3>

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
            <button class="boton-verde" type="submit">Agregar</button>
            
        </form>
    </div>
    
    <script src="js/menuUsuario.js"></script>
    <footer class="footer">
        <div>
            <p class="footer__derechos">&copy; 2024 Feria Virtual CR. Todos los derechos reservados.</p>            
        </div>
    </footer>
</body>

</html>