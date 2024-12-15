<?php
$titulo = 'Emprendimientos';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>


<!-- Este lo puse aqui por que no me sirvio llamar la ruta del "db.php" Si alguien pudiera probarlo  -->
<?php
$servername = "localhost";
$username = "root";
$password = ".";
$database = "db_feria_virtual_cr";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
    die("Conexio fallida");
}
?>

 <?php
$consulta = "SELECT nombre_emprendimiento, descripcion_larga FROM tab_emprendimientos WHERE id_emprendimiento = 2" ;
$resultado = $conn->query($consulta);
?>

<!-- ============================================================= -->
<div class="main-cont">

    <select class="main-cont__dropdown">
        <option value="" disabled selected>Elija una categoría...</option>
        <option value="opcion1">Opción 1</option>
        <option value="opcion2">Opción 2</option>
        <option value="opcion3">Opción 3</option>
    </select>

    <div class="main-cont__emprendimientos">
        <?php
        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                ?>
                <div class="emprendimiento">
                    <img class="emprendimiento__img" src="/AmbienteWeb/public/img/E.png">
                    <h3 class="emprendimiento__nombre"><?php echo htmlspecialchars($fila['nombre_emprendimiento']); ?></h3>
                    <p class="emprendimiento__descripcion"><?php echo htmlspecialchars($fila['descripcion_larga']); ?></p>
                    <button class="ingresar" onclick="window.location.href='/AmbienteWeb/views/usuarios/emprendedor1.php'">Ingresar</button>
                </div>
                <?php
            }
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
        ?>
    </div>

    <?php
        $consulta = "SELECT nombre_emprendimiento, descripcion_larga FROM tab_emprendimientos WHERE id_emprendimiento = 3" ;
        $resultado = $conn->query($consulta);
        ?>
        <div class="main-cont__emprendimientos">
    <?php
        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                ?>
                <div class="emprendimiento">
                    <img class="emprendimiento__img" src="/AmbienteWeb/public/img/joyeria.png">
                    <h3 class="emprendimiento__nombre"><?php echo htmlspecialchars($fila['nombre_emprendimiento']); ?></h3>
                    <p class="emprendimiento__descripcion"><?php echo htmlspecialchars($fila['descripcion_larga']); ?></p>
                    <button class="ingresar" onclick="window.location.href='/AmbienteWeb/views/usuarios/emprendedor1.php'">Ingresar</button>
                </div>
                <?php
            }
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
        ?>
    </div>

    <?php
        $consulta = "SELECT nombre_emprendimiento, descripcion_larga FROM tab_emprendimientos WHERE id_emprendimiento = 4" ;
        $resultado = $conn->query($consulta);
        ?>
        <div class="main-cont__emprendimientos">
    <?php
        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                ?>
                <div class="emprendimiento">
                    <img class="emprendimiento__img" src="/AmbienteWeb/public/img/emprendimiento3.png">
                    <h3 class="emprendimiento__nombre"><?php echo htmlspecialchars($fila['nombre_emprendimiento']); ?></h3>
                    <p class="emprendimiento__descripcion"><?php echo htmlspecialchars($fila['descripcion_larga']); ?></p>
                    <button class="ingresar" onclick="window.location.href='/AmbienteWeb/views/usuarios/emprendedor1.php'">Ingresar</button>
                </div>
                <?php
            }
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
        ?>
    </div>

<style>
    .ingresar{
        background-color: var(--verde-oscuro); 
        color: var(--texto-claro);
        padding: 10px 20px; 
        border: none; 
        border-radius: var(--border-radius); 
        cursor: pointer; 
        font-weight: 700;
        transition: background-color 0.3s, transform 0.3s; /* Transición suave */ 
    }
</style>
 

<?php
require_once '../layout/footer.php';
?>