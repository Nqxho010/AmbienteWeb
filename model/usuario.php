<?php
require_once 'db.php';

class Usuario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerDetallesUsuario($id_usuario) {
        try {
            $query = "SELECT 
                        u.id_usuario, 
                        u.nombre, 
                        u.apellidos, 
                        u.correo, 
                        u.detalle_direccion, 
                        p.detalle AS provincia, 
                        t.detalle AS tipo_usuario 
                      FROM TAB_USUARIOS u
                      LEFT JOIN TAB_PROVINCIAS p ON u.id_provincia = p.id_provincia
                      LEFT JOIN TAB_TIPO_USUARIO t ON u.id_tipo_usuario = t.id_tipo_usuario
                      WHERE u.id_usuario = ? AND u.soft_delete = 0";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id_usuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                return false;
            }

            return $result->fetch_assoc();
        } catch (Exception $e) {
            error_log("Error al obtener detalles del usuario: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $id_provincia, $detalle_direccion) {
        try {
            $query = "UPDATE TAB_USUARIOS 
                      SET nombre = ?, 
                          apellidos = ?, 
                          correo = ?, 
                          id_provincia = ?, 
                          detalle_direccion = ? 
                      WHERE id_usuario = ? AND soft_delete = 0";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sssssi", $nombre, $apellidos, $correo, $id_provincia, $detalle_direccion, $id_usuario);
            $resultado = $stmt->execute();
            $stmt->close();

            return $resultado;
        } catch (Exception $e) {
            error_log("Error al actualizar el usuario: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerProvincias() {
        try {
            $query = "SELECT id_provincia, detalle FROM TAB_PROVINCIAS";
            $result = $this->conn->query($query);

            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            }

            return [];
        } catch (Exception $e) {
            error_log("Error al obtener provincias: " . $e->getMessage());
            return [];
        }
    }
    
}
