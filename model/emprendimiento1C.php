<?php
require_once 'db.php';

class Emprendimiento {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function obtenerProductosPorEmprendimiento() {
        try {
            // Consulta para obtener productos vinculados al ID del emprendimiento 2
            $sql = "SELECT id_producto, nombre_producto, descripcion, precio FROM tab_productos WHERE id_emprendimiento = 2";
            
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la consulta: " . $this->conn->error);
            }

            $stmt->execute();
            $resultado = $stmt->get_result();

            $productos = [];
            while ($fila = $resultado->fetch_assoc()) {
                $productos[] = $fila;
            }

            $stmt->close();
            return $productos;
        } catch (Exception $e) {
            error_log("Error al obtener productos: " . $e->getMessage());
            return false;
        }
    }
}
