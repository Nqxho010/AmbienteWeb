<?php
require_once 'db.php';

class Pedido {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    /**
     * Insertar un nuevo pedido y retornar el ID del pedido creado.
     *
     * @param int $idUsuario
     * @param int $idEstadoPedido
     * @return int|false
     */
    public function insertarPedido($idUsuario) {
        try {
            $sql = "INSERT INTO TAB_PEDIDOS (id_usuario) VALUES (?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }
            $stmt->bind_param("i", $idUsuario);
            if ($stmt->execute()) {
                $insertId = $this->conn->insert_id;
                $stmt->close();
                return $insertId;
            } else {
                $stmt->close();
                return false;
            }
        } catch (Exception $e) {
            error_log("Error al insertar pedido: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Insertar un producto en el pedido.
     *
     * @param int $idPedido
     * @param int $idProducto
     * @param int $cantidad
     * @param float $precioUnitario
     * @return bool
     */
    public function insertarProductoPedido($idPedido, $idProducto, $cantidad, $precioUnitario) {
        try {
            $sql = "INSERT INTO TAB_PRODUCTOS_PEDIDO (id_pedido, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }
            $stmt->bind_param("iiid", $idPedido, $idProducto, $cantidad, $precioUnitario);
            $resultado = $stmt->execute();
            $stmt->close();
            return $resultado;
        } catch (Exception $e) {
            error_log("Error al insertar producto en el pedido: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPedidoPorId($idPedido) {
        try {
            $sql = "SELECT p.id_pedido, p.id_usuario, p.fecha, ep.detalle AS estado_pedido
                    FROM TAB_PEDIDOS p
                    INNER JOIN TAB_ESTADO_PEDIDO ep ON p.id_estado_pedido = ep.id_estado_pedido
                    WHERE p.id_pedido = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }
            $stmt->bind_param("i", $idPedido);
            $stmt->execute();
            $result = $stmt->get_result();
            $pedido = $result->fetch_assoc();
            $stmt->close();
            return $pedido;
        } catch (Exception $e) {
            error_log("Error al obtener pedido: " . $e->getMessage());
            return false;
        }
    }


    public function obtenerProductosDelPedido($idPedido) {
        try {
            $sql = "SELECT pp.id_producto, p.nombre_producto, pp.cantidad, pp.precio_unitario, (pp.cantidad * pp.precio_unitario) AS total
                    FROM TAB_PRODUCTOS_PEDIDO pp
                    INNER JOIN TAB_PRODUCTOS p ON pp.id_producto = p.id_producto
                    WHERE pp.id_pedido = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }
            $stmt->bind_param("i", $idPedido);
            $stmt->execute();
            $result = $stmt->get_result();
            $productos = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $productos;
        } catch (Exception $e) {
            error_log("Error al obtener productos del pedido: " . $e->getMessage());
            return [];
        }
    }
}
?>
