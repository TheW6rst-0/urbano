function logoutAdmin() {
    // Eliminar cualquier dato relacionado con el admin en el localStorage
    localStorage.removeItem('isLoggedIn');
    localStorage.removeItem('isAdmin'); // Si usas un valor específico para el admin
    
    // Redirigir al usuario al index.html
    window.location.href = 'index.php';
}
