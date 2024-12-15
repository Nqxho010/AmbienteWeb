<?php
$titulo = 'Index Emprendedores';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>
    <link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/Emprendedores.css">

        <br>
        <div class="grid-container-wel">

            <div><h2>Bienvenidos a la mejor feria virtual de CR</h2></div>
            
                <div class="grid-texto"><p>Te damos la bienvenida a una feria virtual donde el espíritu emprendedor de Costa Rica brilla en cada rincón. Aquí, emprendedores locales de todo el pais tienen la oportunidad de mostrar y vender sus productos, acercándolos a personas como tú que valoran lo hecho con pasión y dedicación. Aquí, encontrarás una variedad de productos que representan lo mejor de nuestro talento local.Únete a nosotros para apoyar el crecimiento de pequeños negocios que sueñan en grande. Con cada compra, no solo te llevas un producto de calidad, sino que también ayudas a construir un país donde el emprendimiento puede prosperar.</p></div>
    
        </div>

        <br>

        <div class="carousel-container-emp"><!--emprendedores-->
            <?php include '../../model/carrouselindexemp.php'; ?>
        </div>
    
    <script src="js/menuUsuario.js"></script>
    

    <?php require_once '../layout/footer.php'; ?>
    