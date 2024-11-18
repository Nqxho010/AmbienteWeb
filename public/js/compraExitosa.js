const svg = document.getElementById('check')
svg.classList.add('progress')
setInterval(() => {
  svg.classList.toggle('progress')
  svg.classList.toggle('ready')
}, 3000)

const txt = document.getElementById('compraExitosa');
txt.classList.add('progress');

setInterval(() => {
  txt.classList.toggle('progress');
  txt.classList.toggle('ready');
}, 3100); 

//----------------------------------------------------------ANIMACION DEL BOTON-------------------------------------

//const prueba = document.getElementById('pruebaID');
//txt.classList.add('progress');

//setInterval(() => {
  //prueba.classList.toggle('progress');
  //prueba.classList.toggle('ready');
//}, 3100); 