let cantidad = 1;

function incrementar() {
    cantidad++;
    document.getElementById("cantidad").innerText = cantidad;
}

function decrementar() {
    if (cantidad > 1) {
        cantidad--;
        document.getElementById("cantidad").innerText = cantidad;
    }
}

function comprar() {
    alert(`Has seleccionado ${cantidad} unidades.`);
}