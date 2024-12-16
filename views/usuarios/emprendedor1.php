<?php
$titulo = ' Emprendedor 1';
require_once '../layout/header.php';
?>
	<link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/header.css">
	<link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/footer.css">
	<link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/emprendedor1.css">
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
			$id_emprendimiento = 2;
			$consulta = "SELECT * FROM `tab_productos` WHERE `id_emprendimiento` = $id_emprendimiento;";
			$resultado = $conn->query($consulta);
			if ($resultado && $resultado->num_rows > 0) {
				while ($fila = $resultado->fetch_assoc()) {
						?>
						<div class="producto">
						<img class="imagen_producto" src="<?php echo htmlspecialchars($fila['url_imagen']); ?>" alt="<?php echo htmlspecialchars($fila['nombre_producto']); ?>">
								<h3 class="nombre_producto"><?php echo htmlspecialchars($fila['nombre_producto']); ?></h3>
								<p class="descripcion"><?php echo htmlspecialchars($fila['descripcion']); ?></p>
								<p><strong>Precio:</strong> ¢<?php echo htmlspecialchars($fila['precio']); ?></p>
								<button class="agregar" onclick="agregarAlCarrito(<?php echo $fila['id_producto']; ?>)">
                                Agregar al carrito
                                </button>
						</div>
						<?php
				}
		} else {
				echo "<p>No se encontraron productos para el emprendimiento con ID 2.</p>";
		}
?>

		
		<style>		
.producto {
    width: 300px;
    padding: 20px;
    margin: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s;
    vertical-align: top;
    text-align: center;
    overflow: hidden;
    box-sizing: border-box;
}

.imagen_producto {
    width: 100%; 
    max-width: 300px; 
    height: auto; 
    border-radius: 10px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    margin-bottom: 15px; 
    object-fit: cover; 
}


.nombre_producto {
    font-size: 24px;
    font-weight: bold;
		text-align: center;
    color: #333;
    margin-bottom: 10px;
}


.descripcion {
    font-size: 16px;
    color: #666;
		text-align: center;
    margin-bottom: 15px;
}

p{
	text-align: center;
}

p strong {
    font-weight: bold;
    color: #000;
}

.agregar{
	background-color: var(--verde-oscuro); 
        color: var(--texto-claro);
        padding: 10px 20px; 
        border: none; 
        border-radius: var(--border-radius); 
        cursor: pointer; 
        font-weight: 700;
        transition: background-color 0.3s, transform 0.3s; 
}


.container-productos {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

		</style>
		
		<?php require_once '../layout/footer.php'; ?>

