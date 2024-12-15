<?php
require_once 'db.php';

class Producto {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerTodosLosProductos() {
        $sql = "SELECT 
            id_producto,
            nombre_producto,
            descripcion,
            precio,
            stock,
            url_imagen        
        FROM TAB_PRODUCTOS
        WHERE soft_delete = 0";
        $resultado = $this->conn->query($sql);

        if ($resultado === false) {
            throw new Exception("Error en la consulta: " . $this->conn->error);
        }

        $productos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }

        return $productos;
    }

    public function obtenerProductosPorCategoria($categoriaId) {
        $sql = "SELECT 
            id_producto,
            nombre_producto,
            descripcion,
            precio,
            stock,
            url_imagen
        FROM TAB_PRODUCTOS 
        WHERE id_categoria = ? and soft_delete = 0";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error en la consulta: " . $this->conn->error);
        }

        $stmt->bind_param('i', $categoriaId);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $productos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }

        $stmt->close();
        return $productos;
    }

    public function obtenerProductoPorId($id_producto) {
        try {
            $sql = "SELECT 
                        p.id_producto,
                        p.nombre_producto, 
                        p.descripcion, 
                        p.precio, 
                        p.stock, 
                        p.url_imagen, 
                        c.detalle AS categoria,
                        e.nombre_emprendimiento,
                        p.id_emprendimiento
                    FROM TAB_PRODUCTOS p
                    INNER JOIN TAB_CATEGORIAS c ON p.id_categoria = c.id_categoria
                    INNER JOIN TAB_EMPRENDIMIENTOS e ON p.id_emprendimiento = e.id_emprendimiento
                    WHERE p.id_producto = ? AND p.soft_delete = 0";
            
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }

            $stmt->bind_param("i", $id_producto);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows === 0) {
                return false; // Producto no encontrado
            }

            $producto = $resultado->fetch_assoc();
            $stmt->close();
            return $producto;
        } catch (Exception $e) {
            error_log("Error al obtener el producto: " . $e->getMessage());
            return false;
        }
    }

    public function crearProducto($id_emprendimiento, $id_categoria, $nombre_producto, $descripcion, $precio, $stock, $url_imagen) {
        try {
            $sql = "INSERT INTO TAB_PRODUCTOS 
                        (id_emprendimiento, id_categoria, nombre_producto, descripcion, precio, stock, url_imagen, soft_delete) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
            
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }

            $stmt->bind_param("iissdis", $id_emprendimiento, $id_categoria, $nombre_producto, $descripcion, $precio, $stock, $url_imagen);
            
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } catch (Exception $e) {
            error_log("Error al crear el producto: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarProducto($id_producto) {
        try {
            $sql = "UPDATE TAB_PRODUCTOS SET soft_delete = 1 WHERE id_producto = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }

            $stmt->bind_param("i", $id_producto);
            $resultado = $stmt->execute();
            $stmt->close();
            return $resultado;
        } catch (Exception $e) {
            error_log("Error al eliminar el producto: " . $e->getMessage());
            return false;
        }
    }


    public function actualizarStock($id_producto, $nuevo_stock) {
        try {
            $sql = "UPDATE TAB_PRODUCTOS SET stock = ? WHERE id_producto = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }

            $stmt->bind_param("ii", $nuevo_stock, $id_producto);
            $resultado = $stmt->execute();
            $stmt->close();
            return $resultado;
        } catch (Exception $e) {
            error_log("Error al actualizar el stock: " . $e->getMessage());
            return false;
        }
    }


}
?>
