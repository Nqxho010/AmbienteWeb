
////////////////////////////////////////////////////////////////////////////////////
// Codigo para controlar menu de usuario
document.getElementById("userIcon").addEventListener("click", function (event) {
    event.preventDefault();    
    document.getElementById("userDropdown").classList.toggle("user-menu__dropdown--active");
});

// Cerrar el menú desplegable si se da clic en cualquier otro lado
document.addEventListener("click", function (event) {
    const userMenu = document.querySelector(".user-menu");
    const userDropdown = document.getElementById("userDropdown");    
    
    if (!userMenu.contains(event.target)) {
        userDropdown.classList.remove("user-menu__dropdown--active"); 
    }
});
////////////////////////////////////////////////////////////////////////////////////