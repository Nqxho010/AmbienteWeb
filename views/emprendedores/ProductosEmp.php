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

        <div>
            <h2>Lista de Productos</h2>
            <button class="boton-verde">Agregar</button>
    <table class="table-productos">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Producto 1</td>
                <td>Serum Humectante</td>
                <td>₡10500</td>
                <td>20</td>
                <td>
                <button class="boton-verde">Editar</button>
                <button class="boton-rojo">Eliminar</button>
                </td>
            </tr>
            <tr>
                <td>Producto 2</td>
                <td>Exfoliante Natural</td>
                <td>₡11500</td>
                <td>10</td>
                <td>
                <button class="boton-verde">Editar</button>
                <button class="boton-rojo">Eliminar</button>
                </td>
            </tr>
            <tr>
                <td>Producto 3</td>
                <td>Pasta de Dientes Natural</td>
                <td>₡10500</td>
                <td>15</td>
                <td>
                <button class="boton-verde">Editar</button>
                <button class="boton-rojo">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
        </div>
    
    <script src="js/menuUsuario.js"></script>
    <footer class="footer">
        <div>
            <p class="footer__derechos">&copy; 2024 Feria Virtual CR. Todos los derechos reservados.</p>            
        </div>
    </footer>
</body>

</html>