
<?php
class Provincia {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function obtenerProvincias() {
        try {
            $sql = "SELECT id_provincia, detalle FROM TAB_PROVINCIAS";
            $result = $this->conn->query($sql);

            $provincias = [];
            while ($row = $result->fetch_assoc()) {
                $provincias[] = $row;
            }
            return $provincias;
        } catch (Exception $e) {
            return [];
        }
    }
}
?>