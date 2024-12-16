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

    public function obtenerDetalleEmprendimiento($id_emprendimiento) {
        try {
            $query = "SELECT 
                          nombre_emprendimiento, 
                          descripcion_corta, 
                          descripcion_larga, 
                          telefono,
                          id_provincia,
                          detalle_direccion,
                          COALESCE(url_imagen_perfil, 'https://ecommerce.navasola.com/assets/images/image-not-found.png') AS url_imagen_perfil
                      FROM 
                          TAB_EMPRENDIMIENTOS 
                      WHERE 
                          id_emprendimiento = ? 
                          AND soft_delete = 0";
            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }
            $stmt->bind_param('i', $id_emprendimiento);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                return null; 
            }

            return $result->fetch_assoc();
        } catch (Exception $e) {
            error_log("Error al obtener el detalle del emprendimiento: " . $e->getMessage());
            return null;
        }
    }

    public function actualizarEmprendimiento($id_emprendimiento, $nombre, $descripcionCorta, $descripcionLarga, $telefono, $urlImagen, $idProvincia, $detalleDireccion) {
        try {
            // Asegurarse de que los campos numéricos estén en formato int
            $telefono = (int)$telefono;
            $idProvincia = (int)$idProvincia;
            $id_emprendimiento = (int)$id_emprendimiento;

            $query = "UPDATE TAB_EMPRENDIMIENTOS 
                      SET 
                          nombre_emprendimiento = ?, 
                          descripcion_corta = ?, 
                          descripcion_larga = ?, 
                          telefono = ?, 
                          url_imagen_perfil = ?, 
                          id_provincia = ?, 
                          detalle_direccion = ?
                      WHERE 
                          id_emprendimiento = ? AND soft_delete = 0";

            $stmt = $this->conn->prepare($query);

            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }

            // ss s i s i s i
            // nombre (s), descripcionCorta (s), descripcionLarga (s), telefono (i), urlImagen (s), idProvincia(i), detalleDireccion(s), id_emprendimiento(i)
            $stmt->bind_param(
                "sssisisi",
                $nombre,
                $descripcionCorta,
                $descripcionLarga,
                $telefono,
                $urlImagen,
                $idProvincia,
                $detalleDireccion,
                $id_emprendimiento
            );

            $resultado = $stmt->execute();
            $stmt->close();
            return $resultado;
        } catch (Exception $e) {
            error_log("Error al actualizar el emprendimiento: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerEmprendimientosPorCategoria($id_categoria) {
        try {
            $query = "SELECT 
                        e.id_emprendimiento, 
                        e.nombre_emprendimiento, 
                        e.descripcion_corta, 
                        e.url_imagen_perfil 
                      FROM TAB_EMPRENDIMIENTOS e
                      INNER JOIN TAB_EMPRENDIMIENTO_CATEGORIAS ec ON e.id_emprendimiento = ec.id_emprendimiento
                      WHERE ec.id_categoria = ? AND e.soft_delete = 0";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id_categoria);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                return [];
            }

            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log("Error al obtener emprendimientos por categoría: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerEmprendimientoPorId($id_emprendimiento) {
        try {
            $sql = "SELECT 
                        e.id_emprendimiento,
                        e.nombre_emprendimiento,
                        e.descripcion_corta,
                        e.descripcion_larga,
                        e.telefono,
                        e.url_imagen_perfil,
                        e.detalle_direccion,
                        CONCAT(u.nombre, ' ', u.apellidos) AS nombre_propietario
                    FROM TAB_EMPRENDIMIENTOS e
                    INNER JOIN TAB_USUARIOS u ON e.id_usuario = u.id_usuario
                    WHERE e.id_emprendimiento = ? AND e.soft_delete = 0";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id_emprendimiento);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows === 0) {
                return false; // No se encontró el emprendimiento
            }
    
            return $result->fetch_assoc();
        } catch (Exception $e) {
            error_log("Error al obtener el emprendimiento: " . $e->getMessage());
            return false;
        }
    }
}
