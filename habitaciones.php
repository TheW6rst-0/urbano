<?php session_start(); ?>  <!-- Inicia la sesión o reanuda una existente -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitaciones</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/habitaciones.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Hotel Mérida INN</h1>
            </div>
            <div class="nav-right">
                <ul class="nav-main">
                    <!-- Menú desplegable -->
                    <li class="dropdown">
                        <a href="#" class="dropbtn">Menú</a>
                        <ul class="dropdown-content">
                            <li><a href="index.php">Inicio</a></li>
                            <li><a href="habitaciones.php">Habitaciones</a></li>
                            <li><a href="carrito.html">Carrito</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Evita duplicar botones de login/logout -->
                <ul class="nav-login">
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <li><a href="logout.php" class="login">Cerrar sesión (<?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?>)</a></li>
                    <?php else: ?>
                        <li><a href="#" class="login" onclick="openPopup('loginPopup')">Log In</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section class="habitaciones">
            <h1>Nuestras Habitaciones</h1>
            <div class="habitaciones-grid">
                <div class="habitacion">
                    <img src="images/habitaciones/sStandard2.jpg" alt="Habitación Estándar">
                    <h3>Habitación Estándar</h3>
                    <p>Confort y practicidad para tu descanso. Ideal para 1 a 2 personas que buscan una estancia acogedora y sencilla.</p>
                    <a href="habitacion-estandar.html">Ver más</a>
                </div>
                <div class="habitacion">
                    <img src="images/habitaciones/sDeluxe1.jpg" alt="Habitación Deluxe">
                    <h3>Habitación Deluxe</h3>
                    <p>Disfruta de lujo y comodidad con detalles exclusivos. Perfecta para 1 a 2 personas que desean una experiencia más refinada.</p>
                    <a href="habitacion-deluxe.html">Ver más</a>
                </div>
                <div class="habitacion">
                    <img src="images/habitaciones/dStandard1.jpg" alt="Habitación Doble">
                    <h3>Habitación Doble</h3>
                    <p>Espacio amplio para compartir momentos inolvidables. Para 1 a 4 personas, ideal para familias o amigos.</p>
                    <a href="habitacion-doble.html">Ver más</a>
                </div>
                <div class="habitacion">
                    <img src="images/habitaciones/dDeluxe1.jpg" alt="Habitación Doble Deluxe">
                    <h3>Habitación Doble Deluxe</h3>
                    <p>Lujo y amplitud para quienes buscan lo mejor. Perfecta para grupos de amigos o familias que desean un nivel superior de confort y estilo.</p>
                    <a href="habitacion-doble-deluxe.html">Ver más</a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Hotel Mérida INN. Todos los derechos reservados.</p>
    </footer>

    <!-- Pop-up de Log In -->
    <div id="loginPopup" class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('loginPopup')">&times;</span>
            <h2>Iniciar Sesión</h2>
            <form action="login.php" method="POST">
                <label for="loginEmail">Correo:</label>
                <input type="email" id="loginEmail" name="loginEmail" placeholder="Ingresa tu correo" required>
                <label for="loginPassword">Contraseña:</label>
                <input type="password" id="loginPassword" name="loginPassword" placeholder="Ingresa tu contraseña" required>
                <button type="submit" name="login">Iniciar Sesión</button>
            </form>
            <p>¿No tienes cuenta? <a href="#" onclick="openPopup('registerPopup')">Regístrate aquí</a></p>
        </div>
    </div>
    
    <!-- Pop-up de Registro -->
    <div id="registerPopup" class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('registerPopup')">&times;</span>
            <h2>Registro</h2>
            <form action="register.php" method="POST">
                <label for="registerName">Nombre:</label>
                <input type="text" id="registerName" name="registerName" placeholder="Ingresa tu nombre" required>
                <label for="registerEmail">Correo:</label>
                <input type="email" id="registerEmail" name="registerEmail" placeholder="Ingresa tu correo" required>
                <label for="registerPassword">Contraseña:</label>
                <input type="password" id="registerPassword" name="registerPassword" placeholder="Crea tu contraseña" required>
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>
    
    <script src="scripts/popup.js"></script>
    <script src="scripts/authLogButton.js"></script>
</body>
</html>
