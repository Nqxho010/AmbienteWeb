<?php
require_once '../model/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start(); // Asegúrate de iniciar la sesión

    try {
        // Verificar que los datos requeridos están disponibles
        if (!isset($_SESSION['idEmprendimiento'])) {
            error_log("Error: idEmprendimiento no está definido en la sesión.");
            header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
            exit;
        }

        // Datos del formulario
        $idEmprendimiento = $_SESSION['idEmprendimiento'];
        $nombreProducto = $_POST['nombreProducto'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;
        $precio = $_POST['precio'] ?? null;
        $stock = $_POST['stock'] ?? null;
        $idCategoria = $_POST['idCategoria'] ?? null;
        $rutaImagen = $_POST['imagen'] ?? null;

        // Registrar los datos recibidos para depuración
        error_log("Datos recibidos: " . print_r([
            'idEmprendimiento' => $idEmprendimiento,
            'nombreProducto' => $nombreProducto,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
            'idCategoria' => $idCategoria,
            'imagen' => $rutaImagen,
        ], true));

        // Validación básica de datos
        if (!$nombreProducto || !$descripcion || !$precio || !$stock || !$idCategoria || !$rutaImagen) {
            error_log("Error: Datos faltantes o inválidos.");
            header("Location: /AmbienteWeb/views/emprendedores/crearProducto.php?error=Datos%20faltantes%20o%20inválidos");
            exit;
        }

        // Instanciar el modelo de producto
        require_once '../model/db.php'; // Asegúrate de que $conn esté inicializado correctamente
        $productoModel = new Producto($conn);

        // Intentar crear el producto
        error_log("Iniciando creación del producto...");
        $resultado = $productoModel->crearProducto($idEmprendimiento, $idCategoria, $nombreProducto, $descripcion, $precio, $stock, $rutaImagen);

        if ($resultado) {
            error_log("Producto creado correctamente.");
            header("Location: /AmbienteWeb/views/emprendedores/misProductos.php?success=Producto%20creado%20correctamente");
        } else {
            error_log("Error: No se pudo crear el producto. Verifica los datos o la conexión.");
            header("Location: /AmbienteWeb/views/emprendedores/crearProducto.php?error=No%20se%20pudo%20crear%20el%20producto");
        }
    } catch (Exception $e) {
        // Registrar cualquier excepción que ocurra
        error_log("Excepción en el controlador al crear producto: " . $e->getMessage());
        header("Location: /AmbienteWeb/views/emprendedores/crearProducto.php?error=Error%20interno");
    }
} else {
    // Método HTTP inválido
    error_log("Error: Método HTTP no permitido.");
    header("Location: /AmbienteWeb/views/emprendedores/crearProducto.php?error=Método%20no%20permitido");
    exit;
}
