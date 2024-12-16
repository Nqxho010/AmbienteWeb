<?php
require_once('../model/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Datos recibidos:\n";
    print_r($_POST);

    $username = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        echo "Por favor, complete todos los campos.";
    } else {
        // Comprobar si el usuario ya existe
        $sql = "SELECT * FROM tab_usuarios WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "El usuario ya existe.";
        } else {
            // Hashear la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Ejecucion de SQL
            $sql = "INSERT INTO tab_usuarios (correo, contrasenia) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                echo "Usuario registrado exitosamente.";
                header("Location: /AmbienteWeb/index.php");
                exit(); 
            } else {
                echo "Error al registrar el usuario.";
            }
        }
        $stmt->close();
    }
} else {
    echo "Método no permitido. Por favor, use un formulario válido.";
}

$conn->close();
?>
