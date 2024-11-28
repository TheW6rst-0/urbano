// Función para abrir un pop-up
function openPopup(popupId) {
    document.getElementById(popupId).style.display = "flex";
}

// Función para cerrar un pop-up
function closePopup(popupId) {
    document.getElementById(popupId).style.display = "none";
}

// Asociar el botón Log In del header con el pop-up
document.querySelectorAll('.login').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault(); // Evitar que recargue la página
        openPopup('loginPopup'); // Mostrar el pop-up de Log In
    });
});

// Evitar que el enlace recargue o redirija la página
document.querySelectorAll('.login').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault(); // Evitar la acción predeterminada del enlace
        openPopup('loginPopup'); // Mostrar el pop-up de Log In
    });
});

