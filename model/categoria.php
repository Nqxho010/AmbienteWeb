<?php
require_once 'db.php';

class Categoria {
    private $conn;

    public function __construct() {
        global $conn; 
        $this->conn = $conn;
    }

    public function obtenerTodasLasCategorias() {
        try {
            $sql = "SELECT id_categoria, detalle FROM TAB_CATEGORIAS";
            
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la consulta: " . $this->conn->error);
            }

            $stmt->execute();
            $resultado = $stmt->get_result();

            $categorias = [];
            while ($fila = $resultado->fetch_assoc()) {
                $categorias[] = $fila;
            }

            $stmt->close();
            return $categorias;
        } catch (Exception $e) {
            error_log("Error al obtener las categorías: " . $e->getMessage());
            return false;
        }
    }
}
