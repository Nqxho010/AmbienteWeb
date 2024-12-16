<?php
require_once '../models/emprendimiento.php';
require_once '../model/db.php';

class EmprendimientoController {
    private $model;

    public function __construct($conn) {
        $this->model = new Emprendimiento($conn);
    }

    public function listar($id_usuario) {
        return $this->model->obtenerEmprendimientosPorUsuario($id_usuario);
    }

    //hace falta modificar ya que no solo agreaga eso 
    public function crear($nombre, $descripcion, $id_usuario) {
        return $this->model->crearEmprendimiento($nombre, $descripcion, $id_usuario);
    }
}

// Ejemplo de uso:
// session_start();
// $id_usuario = $_SESSION['id_usuario'];
// $controller = new EmprendimientoController($conn);
// $emprendimientos = $controller->listar($id_usuario);
?>
