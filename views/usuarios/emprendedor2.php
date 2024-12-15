<?php
$titulo = ' Emprendedor 1';
require_once '../layout/header.php';
?>

	
	<link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/header.css">
	<link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/footer.css">
	<link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/emprendedor1.css">
		<h1 class="emprendimiento1">La orchila Joyeria</h1>
			<div class="item">
				<figure>
					<img
						src="/AmbienteWeb/public/img/E.png"
						alt="producto"
					/>
				</figure>
				<div class="info-product">
					<h2>primerProducto</h2>
					<p>descripcion.</p>
					<button class="btn-add-cart">Añadir al carrito</button>
				</div>
			</div>
			<div class="item">
				<figure>
					<img
						src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1099&q=80"
						alt="producto"
					/>
				</figure>
				<div class="info-product">
					<h2>Reloj</h2>
					<p class="price">$50</p>
					<p>esta seria la desccripcion del producto</p>
					<button class="btn-add-cart">Añadir al carrito</button>
				</div>
			</div>
			<div class="item">
				<figure>
					<img
						src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80"
						alt="producto"
					/>
				</figure>
				<div class="info-product">
					<h2>Smartwatch</h2>
					<p class="price">$90</p>
					<p>esta seria la desccripcion del producto</p>
					<button class="btn-add-cart">Añadir al carrito</button>
				</div>
			</div>
			<div class="item">
				<figure>
					<img
						src="https://images.unsplash.com/photo-1585386959984-a4155224a1ad?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80"
						alt="producto"
					/>
				</figure>
				<div class="info-product">
					<h2>Perfume</h2>
					<p class="price">$50</p>
					<p>esta seria la desccripcion del producto</p>
					<button class="btn-add-cart">Añadir al carrito</button>
				</div>
			</div>
		</div>
		
			<!--
		<script>
			?php include "js/index.js"; ?> Este es el js de los productos(se tiene que cambiar por php)
		</script>
		-->
		<?php require_once '../layout/footer.php'; ?>

