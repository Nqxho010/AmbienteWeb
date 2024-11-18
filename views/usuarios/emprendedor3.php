<?php
$titulo = ' Emprendedor 3';
require_once '../layout/footer.php';
require_once '../layout/header.php';
?>

<!-- Emprendedor 3 -->

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
	</head>
	<style>
	<?php require_once "/AmbienteWeb/public/css/styles.css"; ?>
	</style>
	<body>
	<header>
			
			<!-- Componente de logo -->
			<div class="logo">
				<a href="#" class="logo__link">
				<img src="/AmbienteWeb/public/img/logo.jpg" class="logo__imagen" alt="Logo">
						<span>Feria Virtual CR</span>
				</a>
		</div>

		<!-- Componente de navegación -->
		<nav class="navbar">
				<ul class="navbar__list">
						<li ><a href="#" class="navbar__link">Inicio</a></li>
						<li ><a href="#" class="navbar__link">Emprendedores</a></li>
						<li ><a href="#" class="navbar__link">Productos</a></li>
				</ul>
		</nav>

		<!-- Componente de iconos -->
		<div class="user-menu">            
				<a href="#" class="user-menu__icon" id="userIcon">&#x1F464;</a>

				<div class="user-menu__dropdown" id="userDropdown">
						<a href="#" class="user-menu__item">Iniciar sesión</a>
				</div>
		</div>

			<div class="container-icon">
				<div class="container-cart-icon">
					<svg
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						viewBox="0 0 24 24"
						stroke-width="1.5"
						stroke="currentColor"
						class="icon-cart"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
						/>
					</svg>
					<div class="count-products">
						<span id="contador-productos">0</span>
					</div>
				</div>

				<div class="container-cart-products hidden-cart">
					<div class="row-product hidden">
						<div class="cart-product">
							<div class="info-cart-product">
								<span class="cantidad-producto-carrito">1</span>
								<p class="titulo-producto-carrito">Zapatos Nike</p>
								<span class="precio-producto-carrito">$80</span>
							</div>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								fill="none"
								viewBox="0 0 24 24"
								stroke-width="1.5"
								stroke="currentColor"
								class="icon-close"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									d="M6 18L18 6M6 6l12 12"
								/>
							</svg>
						</div>
					</div>

					<div class="cart-total hidden">
						<h3>Total:</h3>
						<span class="total-pagar">$200</span>
					</div>
					<p class="cart-empty">El carrito está vacío</p>
					<button id="prueba" class="btn-comprar-cart" onclick="window.location.href='carritoDeCompras.php'">Comprar</button>
				</div>
			</div>
		</header>

		<h1 class="emprendedorName">Emprendedor 3</h1>
		<h3 class="productoEmprendedor">Productos</h3>
		<div class="container-items">
			<div class="item">
				<figure>
					<img
						src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
						alt="producto"
					/>
				</figure>
				<div class="info-product">
					<h2>Zapatos Nike</h2>
					<p class="price">$80</p>
					<p>esta seria la desccripcion del producto</p>
					<button class="btn-add-cart">Añadir al carrito</button>
				</div>
			</div>
			<div class="item">
				<figure>
					<img
						src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
						alt="producto"
					/>
				</figure>
				<div class="info-product">
					<h2>Audifonos</h2>
					<p class="price">$20</p>
					<p>esta seria la desccripcion del producto</p>
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
	</body>
</html>