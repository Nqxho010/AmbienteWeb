<?php
require_once 'db.php';


class Cliente {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function registrarUsuario($nombre, $apellidos, $correo, $contrasenia, $id_provincia, $detalle_direccion) {
        try {
            $sql = "INSERT INTO TAB_USUARIOS (nombre, apellidos, correo, contrasenia, id_provincia, detalle_direccion) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            $hashedPassword = password_hash($contrasenia, PASSWORD_BCRYPT); 

            $stmt->bind_param("ssssis", $nombre, $apellidos, $correo, $hashedPassword, $id_provincia, $detalle_direccion);

            if ($stmt->execute()) {
                return true; 
            } else {
                return false; 
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function iniciarSesion($correo, $contrasenia) {
        try {
            $sql = "SELECT 
                        u.id_usuario, 
                        u.id_tipo_usuario, 
                        u.nombre, 
                        u.contrasenia,
                        e.id_emprendimiento 
                    FROM 
                        TAB_USUARIOS u
                    LEFT JOIN 
                        TAB_EMPRENDIMIENTOS e ON u.id_usuario = e.id_usuario
                    WHERE 
                        u.correo = ? AND u.soft_delete = 0";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows === 0) {
                return false; // Usuario no encontrado o eliminado
            }
    
            $usuario = $result->fetch_assoc();
    
            // Verificar contraseña
            if (password_verify($contrasenia, $usuario['contrasenia'])) {
                return [
                    'idUsuario' => $usuario['id_usuario'],
                    'idTipoUsuario' => $usuario['id_tipo_usuario'],
                    'nombre' => $usuario['nombre'],
                    'idEmprendimiento' => $usuario['id_emprendimiento'] ?? null // Puede ser nulo para clientes
                ];
            }
    
            return false; // Contraseña incorrecta
        } catch (Exception $e) {
            error_log("Error al iniciar sesión: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerInformacionCliente($idUsuario) {
        try {
            $sql = "SELECT 
                        u.nombre,
                        u.apellidos,
                        p.detalle AS provincia,
                        u.detalle_direccion 
                    FROM 
                        TAB_USUARIOS u
                    LEFT JOIN 
                        TAB_PROVINCIAS p ON u.id_provincia = p.id_provincia
                    WHERE 
                        u.id_usuario = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (Exception $e) {
            error_log("Error al obtener información del cliente: " . $e->getMessage());
            return [];
        }
    }

    public function cambiarTipoUsuario($idUsuario, $nuevoTipo) {
        try {
            $sql = "UPDATE TAB_USUARIOS SET id_tipo_usuario = ? WHERE id_usuario = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $nuevoTipo, $idUsuario);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error al cambiar tipo de usuario: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerInformacionCompletaUsuario($idUsuario) {
        try {
            $sql = "SELECT 
                        u.nombre,
                        u.apellidos,
                        u.correo,
                        tu.detalle AS tipo_usuario,
                        p.detalle AS provincia,
                        u.detalle_direccion 
                    FROM 
                        TAB_USUARIOS u
                    LEFT JOIN 
                        TAB_PROVINCIAS p ON u.id_provincia = p.id_provincia
                    LEFT JOIN
                        TAB_TIPO_USUARIO tu ON u.id_tipo_usuario = tu.id_tipo_usuario
                    WHERE 
                        u.id_usuario = ?";
    
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }
    
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (Exception $e) {
            error_log("Error al obtener la información completa del usuario: " . $e->getMessage());
            return [];
        }
    }

    public function actualizarDireccionUsuario($idUsuario, $idProvincia, $detalleDireccion) {
        try {
            $sql = "UPDATE TAB_USUARIOS SET id_provincia = ?, detalle_direccion = ? WHERE id_usuario = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isi", $idProvincia, $detalleDireccion, $idUsuario);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error al actualizar dirección: " . $e->getMessage());
            return false;
        }
    }
    
    
    

}
