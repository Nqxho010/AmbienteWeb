<?php
require_once 'db.php';

class Emprendimiento {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerEmprendimientosDestacados($limit = 8) {
        try {
            $query = "SELECT 
                          id_emprendimiento, 
                          nombre_emprendimiento, 
                          descripcion_corta, 
                          COALESCE(url_imagen_perfil, 'https://ecommerce.navasola.com/assets/images/image-not-found.png') AS url_imagen_perfil
                      FROM 
                          TAB_EMPRENDIMIENTOS 
                      WHERE 
                          soft_delete = 0 
                      LIMIT ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i', $limit);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log("Error al obtener emprendimientos destacados: " . $e->getMessage());
            return [];
        }
    }
}
