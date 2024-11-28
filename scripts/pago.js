document.getElementById("formPago").addEventListener("submit", function(event) {
    event.preventDefault();  // Evitar que se envíe el formulario

    // Simulación de validación y procesamiento del pago
    setTimeout(function() {
        // Aquí agregarías la lógica de validación y el backend
        // Si todo está correcto, se muestra el popup de confirmación
        document.getElementById("popupConfirmacion").style.display = "flex";
    }, 1000);  // Simulando un pequeño retraso para procesar el pago
});

// Función para redirigir al menú principal
function redirigirAlMenu() {
    window.location.href = "index.php";  // Redirigir al menú principal
}
