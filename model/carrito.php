<?php
require_once 'db.php';

class Carrito {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function insertarProducto($idUsuario, $idProducto, $cantidad) {
        try {
            $sql = "INSERT INTO TAB_CARRITO_USUARIO (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iii", $idUsuario, $idProducto, $cantidad);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error al insertar producto en el carrito: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarCantidad($idUsuario, $idProducto, $cantidad) {
        try {
            $sql = "UPDATE TAB_CARRITO_USUARIO SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iii", $cantidad, $idUsuario, $idProducto);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error al actualizar la cantidad en el carrito: " . $e->getMessage());
            return false;
        }
    }

    public function existeProducto($idUsuario, $idProducto) {
        try {
            $sql = "SELECT COUNT(*) AS total FROM TAB_CARRITO_USUARIO WHERE id_usuario = ? AND id_producto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $idUsuario, $idProducto);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['total'] > 0;
        } catch (Exception $e) {
            error_log("Error al verificar existencia del producto en el carrito: " . $e->getMessage());
            return false;
        }
    }


    public function eliminarProducto($idUsuario, $idProducto) {
        try {
            $sql = "DELETE FROM TAB_CARRITO_USUARIO WHERE id_usuario = ? AND id_producto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $idUsuario, $idProducto);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    // public function modificarCantidad($idUsuario, $idProducto, $cantidad) {
    //     try {
    //         $sql = "UPDATE TAB_CARRITO_USUARIO SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->bind_param("iii", $cantidad, $idUsuario, $idProducto);
    //         return $stmt->execute();
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }


    public function obtenerProductos($idUsuario) {
        try {
            $sql = "SELECT cu.id_producto, p.nombre_producto, cu.cantidad, p.precio, (cu.cantidad * p.precio) AS total, p.stock 
                    FROM TAB_CARRITO_USUARIO cu
                    INNER JOIN TAB_PRODUCTOS p ON cu.id_producto = p.id_producto
                    WHERE cu.id_usuario = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log("Error al obtener productos del carrito: " . $e->getMessage());
            return [];
        }
    }


    public function vaciarCarrito($idUsuario) {
        try {
            $sql = "DELETE FROM TAB_CARRITO_USUARIO WHERE id_usuario = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idUsuario);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }
}
