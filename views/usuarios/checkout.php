<!-- Es mejor cargar los css asi, que usar required -->
<link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/checkout.css">


<div class="container">
  <div class="card">
    <button class="proceed"><svg class="sendicon" width="24" height="24" viewBox="0 0 24 24" onclick="window.location.href='compraExitosa.php'">
    <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
    </svg></button>
    <img src="https://th.bing.com/th/id/R.3199df0e6d1daa6b20a55c39e60096d8?rik=DBXdYJQdMKduwA&pid=ImgRaw&r=0" class="logo-card">
    <label>Card number:</label>
    <input id="user" type="text" class="input cardnumber"  placeholder="1234 5678 9101 1121">
    <label>Name:</label>
    <input class="input name"  placeholder="Edgar Pérez">
    <label class="toleft">CCV:</label>
    <input class="input toleft ccv" placeholder="321">
</div>

<div class="receipt">
    <div class="col"><p>Cost:</p>
    <h2 class="cost">$</h2><br>  <!-- SE OBTIENE EL COSTO DEL PEDIDO Y SE MUESTRA EL TOTAL -->
    </div>
    <div class="col">
      <p>Bought Items:</p> 
      <!-- SE OBTIENE LOS ITEMS DEL PEDIDO Y SE MUESTRAN -->
       <h4>OBJETOS</h4>
    </div>
    <p class="comprobe">This information will be sended to your email</p>
  </div>
</div>