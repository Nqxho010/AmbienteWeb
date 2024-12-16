<?php
require_once 'db.php';

class Emprendimiento {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function obtenerEmprendimientosDestacados($limit = 8) {
        $query = "SELECT id_emprendimiento, nombre_emprendimiento, descripcion_corta, url_imagen_perfil 
                  FROM TAB_EMPRENDIMIENTOS 
                  WHERE soft_delete = 0 
                  LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    //---
    public function obtenerEmprendimientosPorUsuario($id_usuario) {
        $query = "SELECT * FROM TAB_EMPRENDIMIENTOS WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        $emprendimientos = [];
        while ($row = $result->fetch_assoc()) {
            $emprendimientos[] = $row;
        }
        $stmt->close();
        return $emprendimientos;
    }

    public function crearEmprendimiento($nombre, $descripcion, $id_usuario) {
        $query = "INSERT INTO TAB_EMPRENDIMIENTOS (id_usuario,nombre_emprendimiento, descripcion_larga,telefono,url_imagen_perfil,id_provincia,detalle_direccion,
        descripcion_corta)
         VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $nombre, $descripcion, $id_usuario);

        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }


}
?>
