<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Mérida INN</title>
    <link rel="stylesheet" href="css/styles.css">
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
                            <li><a href="carrito.php">Carrito</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav-login">
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <li><a href="logout.php" class="login">Cerrar sesión
                                (<?php echo $_SESSION['usuario_nombre']; ?>)</a></li>
                    <?php else: ?>
                        <li><a href="#" class="login" onclick="openPopup('loginPopup')">Log In</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Sección de inicio -->
    <section id="inicio">
        <div class="hero">
            <h2>Bienvenido al Hotel Mérida INN</h2>
            <p>Descubre tu próxima experiencia en el corazón de la ciudad.</p>
            <a href="habitaciones.php" class="btn-primary">Explorar Habitaciones</a>
        </div>
    </section>

    <!-- Sección de habitaciones -->
    <section id="habitaciones">
        <h2>Habitaciones Destacadas</h2>
        <div class="habitaciones-grid">
            <!-- Tarjetas dinámicas generadas desde el backend -->
            <div class="habitacion-card">
                <img src="images/habitaciones/sStandard2.jpg" alt="Vista de la habitación">
                <h3>Habitación Estándar</h3>
                <p>Desde $1000 MXN por noche.</p>
                <a href="habitacion-estandar.html" class="btn-secondary">Reservar</a>
            </div>
            <div class="habitacion-card">
                <img src="images/habitaciones/sDeluxe1.jpg" alt="Vista de la habitación">
                <h3>Habitación Deluxe</h3>
                <p>Desde $2000 MXN por noche.</p>
                <a href="habitacion-deluxe.html" class="btn-secondary">Reservar</a>
            </div>
        </div>
    </section>

    <!-- Sección de servicios -->
    <section id="servicios">
        <h2>Nuestros Servicios</h2>
        <p>Disfruta de comodidades como Wi-Fi, gimnasio, alberca, y mucho más.</p>

        <!-- Carrusel -->
        <div class="carrusel">
            <div class="slide active">
                <img src="images/lobby.jpg" alt="Lobby">
            </div>
            <div class="slide">
                <img src="images/gym.jpg" alt="Gimnasio">
            </div>
            <div class="slide">
                <img src="images/pool.jpg" alt="Alberca">
            </div>
            <!-- Controles -->
            <button class="prev">&lt;</button>
            <button class="next">&gt;</button>
        </div>

        <!-- Descripción -->
        <p class="descripcion">
            Junto con la combinación de arte, modernidad y confort, los servicios ofrecidos por nuestro hotel están
            diseñados para hacer de tu estancia una experiencia inolvidable. La atención personalizada de nuestro
            servicio de Guest Relations & Concierge asegura que hasta el más mínimo detalle esté cuidado.
        </p>

        <!-- Botón -->
        <a href="habitaciones.php" class="btn-descubre">Descubre nuestras habitaciones</a>
    </section>

    <!-- Sección de contacto -->
    <section id="contactanos">
        <div class="contacto-contenido">
            <!-- Dirección a la izquierda -->
            <div class="direccion">
                <h3>Dirección</h3>
                <p>Hotel Mérida INN</p>
                <p>Calle Principal #621, Zona Urbana</p>
                <p>Yharnam, Austria</p>
            </div>

            <!-- Datos a la derecha -->
            <div class="datos-contacto">
                <h3>Datos de Contacto</h3>
                <p><strong>Teléfono:</strong> +43 123 456 7890</p>
                <p><strong>Fax:</strong> +43 098 765 4321</p>
                <p><strong>Correo:</strong> contacto@hotelméridaINN.com</p>
            </div>
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
                <input type="password" id="loginPassword" name="loginPassword" placeholder="Ingresa tu contraseña"
                    required>
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
                <label for="registerName">Usuario:</label>
                <input type="text" id="registerName" placeholder="Ingresa tu usuario" required>
                <label for="registerEmail">Correo:</label>
                <input type="email" id="registerEmail" placeholder="Ingresa tu correo" required>
                <label for="registerPassword">Contraseña:</label>
                <input type="password" id="registerPassword" placeholder="Crea tu contraseña" required>
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>

    <script src="scripts/popup.js"></script>
    <script src="scripts/carousel.js"></script>
    <script src="scripts/authLogButton.js"></script>

</body>

</html>