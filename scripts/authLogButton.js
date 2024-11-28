// Función para manejar el estado de logueo y cambiar el texto del botón de Login
function toggleAuth() {
    const loginButton = document.querySelector('.login');
    
    // Verificar si el usuario está logueado
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

    // Si está logueado, cambiar el texto del botón a "Cerrar sesión" y hacer que al hacer click cierre sesión
    if (isLoggedIn) {
        loginButton.textContent = "Cerrar sesión";
        loginButton.addEventListener('click', function() {
            // Eliminar el estado de login en localStorage
            localStorage.removeItem('isLoggedIn');
            
            // Redirigir al menú principal
            window.location.href = "index.php"; // O el enlace del menú principal
        });
    } else {
        // Si no está logueado, cambiar el texto del botón a "Log In" y mostrar el pop-up
        loginButton.textContent = "Log In";
        loginButton.addEventListener('click', function() {
            // Mostrar el pop-up de login (suponiendo que se tenga esta funcionalidad)
            openPopup('loginPopup'); // Asegúrate de tener la función openPopup definida
        });
    }
}

// Llamar a la función al cargar la página para verificar el estado del login
document.addEventListener('DOMContentLoaded', toggleAuth);
