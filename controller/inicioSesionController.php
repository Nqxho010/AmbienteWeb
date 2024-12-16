<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../model/cliente.php'; 

    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($correo) || empty($password)) {
        header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Datos%20incompletos");
        exit;
    }

    $clienteModel = new Cliente($conn);
    $usuario = $clienteModel->iniciarSesion($correo, $password);

    if ($usuario) {
        session_start();
        $_SESSION['idUsuario'] = $usuario['idUsuario'];
        $_SESSION['idTipoUsuario'] = $usuario['idTipoUsuario'];
        $_SESSION['nombreUsuario'] = $usuario['nombre'];

        // Si es emprendedor, guardar el id del emprendimiento
        if ($usuario['idTipoUsuario'] == 2) {
            $_SESSION['idEmprendimiento'] = $usuario['idEmprendimiento'];
        }       

        header("Location: /AmbienteWeb/index.php");    
        
    } else {
        header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Credenciales%20inválidas");
    }
    exit;
}
