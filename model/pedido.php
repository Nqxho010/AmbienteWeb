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
            $sql = "
                SELECT 
                    p.id_pedido,
                    u.nombre AS nombre_usuario,
                    p.fecha,
                    ep.detalle AS estado_pedido,
                    e.nombre_emprendimiento
                FROM TAB_PEDIDOS p
                INNER JOIN TAB_ESTADO_PEDIDO ep ON p.id_estado_pedido = ep.id_estado_pedido
                INNER JOIN TAB_USUARIOS u ON p.id_usuario = u.id_usuario
                INNER JOIN TAB_PRODUCTOS_PEDIDO pp ON p.id_pedido = pp.id_pedido
                INNER JOIN TAB_PRODUCTOS prod ON pp.id_producto = prod.id_producto
                INNER JOIN TAB_EMPRENDIMIENTOS e ON prod.id_emprendimiento = e.id_emprendimiento
                WHERE p.id_pedido = ?
                LIMIT 1;
            ";
    
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

    /**
     * Obtener pedidos con estado Activo o Enviado para un usuario específico.
     *
     * @param int $idUsuario
     * @return array
     */
    public function obtenerPedidosActivosOEnviados($idUsuario) {
        try {
            $sql = "SELECT p.id_pedido, p.fecha, ep.detalle AS estado_pedido
                    FROM TAB_PEDIDOS p
                    INNER JOIN TAB_ESTADO_PEDIDO ep ON p.id_estado_pedido = ep.id_estado_pedido
                    WHERE p.id_usuario = ? AND p.id_estado_pedido IN (1, 2)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();
            $pedidos = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $pedidos;
        } catch (Exception $e) {
            error_log("Error al obtener pedidos activos o enviados: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtener pedidos con estado Cancelado o Entregado para un usuario específico.
     *
     * @param int $idUsuario
     * @return array
     */
    public function obtenerPedidosCanceladosOEntregados($idUsuario) {
        try {
            $sql = "SELECT p.id_pedido, p.fecha, ep.detalle AS estado_pedido
                    FROM TAB_PEDIDOS p
                    INNER JOIN TAB_ESTADO_PEDIDO ep ON p.id_estado_pedido = ep.id_estado_pedido
                    WHERE p.id_usuario = ? AND p.id_estado_pedido IN (3, 4)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();
            $pedidos = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $pedidos;
        } catch (Exception $e) {
            error_log("Error al obtener pedidos cancelados o entregados: " . $e->getMessage());
            return [];
        }
    }

    public function actualizarEstadoPedido($idPedido, $nuevoEstado) {
        try {
            $sql = "UPDATE TAB_PEDIDOS SET id_estado_pedido = ? WHERE id_pedido = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }
            $stmt->bind_param("ii", $nuevoEstado, $idPedido);
            $resultado = $stmt->execute();
            $stmt->close();
            return $resultado;
        } catch (Exception $e) {
            error_log("Error al actualizar el estado del pedido: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPedidosActivosPorEmprendimiento($idEmprendimiento) {
        try {
            $sql = "
                SELECT DISTINCT 
                    p.id_pedido,
                    u.nombre AS nombre_usuario,
                    u.apellidos AS apellidos_usuario,
                    p.fecha,
                    ep.detalle AS estado_pedido
                FROM TAB_PEDIDOS p
                INNER JOIN TAB_PRODUCTOS_PEDIDO pp ON p.id_pedido = pp.id_pedido
                INNER JOIN TAB_PRODUCTOS prod ON pp.id_producto = prod.id_producto
                INNER JOIN TAB_USUARIOS u ON p.id_usuario = u.id_usuario
                INNER JOIN TAB_ESTADO_PEDIDO ep ON p.id_estado_pedido = ep.id_estado_pedido
                WHERE prod.id_emprendimiento = ? 
                  AND p.id_estado_pedido IN (1, 2) -- Activo o Enviado
            ";
            
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }
            $stmt->bind_param("i", $idEmprendimiento);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $pedidos = [];
            while ($pedido = $result->fetch_assoc()) {
                $pedidos[] = $pedido;
            }
            $stmt->close();
            return $pedidos;
        } catch (Exception $e) {
            error_log("Error al obtener pedidos activos por emprendimiento: " . $e->getMessage());
            return [];
        }
    }
    
    
}
?>
