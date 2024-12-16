<?php
$titulo = 'nuevo Producto';
require_once '../layout/head.php';
require_once '../layout/header.php';
require_once '../layout/footer.php';

require_once '../../model/db.php';
require_once '../../controller/Emprendimiento.php';

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../auth/login.php');
    exit;
}
 //hace falta agregar mas parametros
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $id_usuario = $_SESSION['id_usuario'];

    $controller = new EmprendimientoController($conn);
    $creado = $controller->crear($nombre, $descripcion, $id_usuario);

    if ($creado) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error al crear el emprendimiento.";
    }
}

?>
    <link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/Emprendedores.css">

    <h3> Mis productos > Nuevo</h3>
///falta agregar los otros labels
    <div class="flex-container">
        <form class="form" action="" method="">
            
        <label for="nombre">Nombre del Emprendimiento:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>
        <br>
        <button type="submit">Crear</button>
    </form>
    </div>
    
    <script src="js/menuUsuario.js"></script>
