<?php session_start(); ?>  <!-- Inicia la sesión o reanuda una existente -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Reservaciones - Hotel Mérida INN</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/carrito.css">
</head>
<body>
    <!-- Encabezado con navegación -->
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
                            <li><a href="carrito.php">Carrito</a></li> <!-- Cambiar a carrito.php -->
                        </ul>
                    </li>
                </ul>
                <ul class="nav-login">
                    <!-- Si el usuario está autenticado, muestra "Cerrar sesión", si no, muestra "Log In" -->
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <li><a href="logout.php" class="login">Cerrar sesión (<?php echo $_SESSION['usuario_nombre']; ?>)</a></li>
                    <?php else: ?>
                        <li><a href="#" class="login" onclick="openPopup('loginPopup')">Log In</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Sección del Carrito de Reservaciones -->
    <section id="carrito">
        <div class="container">
            <!-- Verificar si el usuario está logueado -->
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <!-- Carrito de Reservaciones -->
                <div id="reservaciones" class="reservaciones">
                    <h2>Tu Carrito de Reservaciones</h2>
                    <!-- Aquí se mostrarán las reservas dinámicamente, con datos de la base de datos -->
                    <div class="reserva">
                        <img src="images/habitaciones/sDeluxe1.jpg" alt="Habitación Deluxe">
                        <div class="reserva-info">
                            <h3>Habitación Deluxe</h3>
                            <p>Fecha de entrada: 01/12/2024</p>
                            <p>Fecha de salida: 03/12/2024</p>
                            <p><strong>Precio: $4000 MXN</strong></p>
                            <button class="btn-cancelar">Cancelar Reserva</button>
                        </div>
                    </div>
                    <!-- Aquí se pueden agregar más tarjetas de reservas -->
                </div>

                <!-- Botón de continuar con la compra -->
                <div id="finalizar-reserva">
                    <h3>Total: $4000 MXN</h3>
                    <a href="pago.php" class="btn-pagar">Finalizar Compra</a>
                </div>
            <?php else: ?>
                <!-- Mensaje si el usuario no ha iniciado sesión -->
                <div id="login-prompt" class="popup">
                    <div class="popup-content">
                        <h2>Por favor, inicie sesión</h2>
                        <p>Para ver y gestionar tus reservaciones, debes iniciar sesión.</p>
                        <button id="login-button" onclick="openPopup('loginPopup')">Iniciar Sesión</button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Pie de página -->
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
            <form>
                <label for="registerName">Nombre:</label>
                <input type="text" id="registerName" placeholder="Ingresa tu nombre" required>
                <label for="registerEmail">Correo:</label>
                <input type="email" id="registerEmail" placeholder="Ingresa tu correo" required>
                <label for="registerPassword">Contraseña:</label>
                <input type="password" id="registerPassword" placeholder="Crea tu contraseña" required>
                <label for="registerPhone">Teléfono:</label>
                <input type="tel" id="registerPhone" placeholder="Ingresa tu teléfono" required>
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>
    
    <script src="scripts/popup.js"></script>
    <script src="scripts/carousel.js"></script>
    <script src="scripts/authLogButton.js"></script>
</body>
</html>
