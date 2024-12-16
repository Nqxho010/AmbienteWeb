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
                          e.id_emprendimiento,
                          e.id_usuario,
                          e.nombre_emprendimiento, 
                          e.descripcion_corta, 
                          e.descripcion_larga, 
                          e.telefono,
                          e.id_provincia,
                          e.detalle_direccion,
                          COALESCE(e.url_imagen_perfil, 'https://ecommerce.navasola.com/assets/images/image-not-found.png') AS url_imagen_perfil
                      FROM 
                          TAB_EMPRENDIMIENTOS e
                      WHERE 
                          e.id_emprendimiento = ? 
                          AND e.soft_delete = 0";
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

    public function crearEmprendimiento($id_usuario, $nombre, $descripcionCorta, $descripcionLarga, $telefono, $urlImagen, $idProvincia, $detalleDireccion) {
        try {
            $telefono = (int)$telefono;
            $idProvincia = (int)$idProvincia;

            $query = "INSERT INTO TAB_EMPRENDIMIENTOS (id_usuario, nombre_emprendimiento, descripcion_larga, telefono, url_imagen_perfil, id_provincia, detalle_direccion, descripcion_corta)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }

            $stmt->bind_param(
                "issisiss",
                $id_usuario,
                $nombre,
                $descripcionLarga,
                $telefono,
                $urlImagen,
                $idProvincia,
                $detalleDireccion,
                $descripcionCorta
            );

            $resultado = $stmt->execute();
            $stmt->close();

            return $resultado;
        } catch (Exception $e) {
            error_log("Error al crear emprendimiento: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerEmprendimientosPorCategoria($idCategoria, $limit = 8) {
        try {
            $query = "SELECT DISTINCT e.id_emprendimiento, 
                                     e.nombre_emprendimiento,
                                     e.descripcion_corta,
                                     COALESCE(e.url_imagen_perfil, 'https://ecommerce.navasola.com/assets/images/image-not-found.png') AS url_imagen_perfil
                      FROM TAB_EMPRENDIMIENTOS e
                      INNER JOIN TAB_EMPRENDIMIENTO_CATEGORIAS ec ON e.id_emprendimiento = ec.id_emprendimiento
                      WHERE e.soft_delete = 0
                        AND ec.id_categoria = ?
                      LIMIT ?";

            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }

            $stmt->bind_param("ii", $idCategoria, $limit);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);

        } catch (Exception $e) {
            error_log("Error al obtener emprendimientos por categoría: " . $e->getMessage());
            return [];
        }
    }


}
