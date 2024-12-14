
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //  Imprimir los datos de inicio de sesión para depuración
    //  echo '<pre>';
    //  echo "Correo: " . htmlspecialchars($_POST['correo']) . "\n";
    //  echo "Password: " . htmlspecialchars($_POST['password']) . "\n";
    //  echo '</pre>';

    require_once '../model/cliente.php'; 

    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($correo) || empty($password)) {
        header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Datos%20incompletos");
        exit;
    }

    $clienteModel = new Cliente($conn);

    $usuario = $clienteModel->iniciarSesion($correo, $password);

    // echo '<pre>';
    // echo "Contenido de \$usuario:\n";
    // var_dump($usuario);
    // echo '</pre>';

    if ($usuario) {
        session_start();
        $_SESSION['idUsuario'] = $usuario['idUsuario'];
        $_SESSION['idTipoUsuario'] = $usuario['idTipoUsuario'];
        $_SESSION['nombreUsuario'] = $usuario['nombre'];

        header("Location: /AmbienteWeb/index.php"); 
    } else {
        header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Credenciales%20inválidas");
    }
    exit;
}
