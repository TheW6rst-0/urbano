<?php
include "Control/Funciones/acceder_base_datos.php";
include "Control/config/config.inc.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Hotel Mérida INN</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <!-- Encabezado con navegación -->
    <header>
        <nav>
            <div class="logo">
                <h1>Hotel Mérida INN - Admin</h1>
            </div>
            <div class="nav-right">
                <ul class="nav-main">
                    <li><a href="admin.php">Panel</a></li>
                    <!-- Aquí redirige a logout.php -->
                    <li><a href="logout.php" class="login">Cerrar sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>
    

    <!-- Contenido del panel de administración -->
    <section id="admin-panel">
        <div class="container">
            <h2>Bienvenido, Administrador</h2>

            <div id="admin-options">
                <!-- Dar de Alta un Cuarto -->
                <div class="option-card">
                    <h3>Dar de Alta un Cuarto</h3>
                    <form action="habitacionesback.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="accion" value="alta_habitacion">
                        <label for="tipo">Tipo de Cuarto:</label>
                        <input type="text" id="tipo" name="txt_tipo" required>
                        
                        <label for="precio">Precio:</label>
                        <input type="number" id="precio" name="txt_precio" required>
                    
                        <label for="capacidad">Capacidad:</label>
                        <input type="number" id="capacidad" name="txt_capacidad" required>
                    
                        <label for="imagenes">Imágenes:</label>
                        <input type="file" id="imagenes" name="imagenes_habitacion[]" multiple>
                        
                        <button type="submit" name="btn_grabar" value="Grabar">Dar Alta</button>
                    </form>
                    
                </div>

                <!-- Editar un Cuarto -->
                <div class="option-card">
                    <h3>Editar un Cuarto</h3>
                    <form action="habitacionesback.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="accion" value="editar_habitacion">
                        
                        <label for="cuarto-id">ID del Cuarto:</label>
                        <input type="number" id="cuarto-id" name="cuarto-id" required>
                        
                        <label for="nuevo-tipo">Nuevo Tipo:</label>
                        <input type="text" id="nuevo-tipo" name="txt_tipo" required>
                        
                        <label for="nuevo-precio">Nuevo Precio:</label>
                        <input type="number" id="nuevo-precio" name="txt_precio" required>
                        
                        <label for="nueva-capacidad">Nueva Capacidad:</label>
                        <input type="number" id="nueva-capacidad" name="txt_capacidad" required>
                        
                        <label for="nuevas-imagenes">Subir Nuevas Imágenes:</label>
                        <input type="file" id="nuevas-imagenes" name="imagenes_habitacion[]" multiple accept="image/*">
                        
                        <button type="submit" name="btn_actualizar" value="Actualizar">Editar</button>
                    </form>
                    
                    
                </div>

                <!-- Eliminar un Cuarto -->
                <div class="option-card">
                    <h3>Eliminar un Cuarto</h3>
                    <form action="habitacionesback.php" method="POST">
                        <input type="hidden" name="accion" value="eliminar_habitacion">
                        <label for="cuarto-id-eliminar">ID del Cuarto:</label>
                        <input type="number" id="cuarto-id-eliminar" name="cuarto-id-eliminar" required>
                        <button type="submit">Eliminar</button>
                    </form>
                </div>

                <!-- Generar Reportes de Cuartos o Servicios -->
                <div class="option-card">
                    <h3>Buscar Habitaciones o Servicios</h3>
                    <form action="habitacionesback.php" method="POST">
                        <input type="hidden" name="accion" value="buscar_habitacion">
                        <label for="criterio-busqueda">Criterio:</label>
                        <select id="criterio-busqueda" name="criterio-busqueda" required>
                            <option value="id_habitacion">ID</option>
                            <option value="tipo">Tipo</option>

                        </select>
                    
                        <label for="valor-busqueda">Valor:</label>
                        <input type="text" id="valor-busqueda" name="valor-busqueda" required>
                    
                        <button type="submit">Buscar</button>
                    </form>
                </div>
            </div>

            <!-- Listado Dinámico de Habitaciones -->
<section id="habitaciones-listadas">
    <h3>Habitaciones Registradas</h3>
    <div id="habitaciones-categorias">
        <?php 
        $habitacionesAgrupadas = obtenerHabitacionesAgrupadas(); // Llamada a la función
        if (!empty($habitacionesAgrupadas)): 
        ?>
            <?php foreach ($habitacionesAgrupadas as $grupo): ?>
                <div class="categoria">
                    <h4>Habitaciones <?= htmlspecialchars($grupo['tipo']) ?></h4>
                    <ul>
                        <?php
                        $habitaciones = explode(',', $grupo['habitaciones']); // Dividir IDs de habitaciones
                        foreach ($habitaciones as $id_habitacion): 
                        ?>
                            <li>Habitación ID: <?= htmlspecialchars($id_habitacion) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay habitaciones registradas.</p>
        <?php endif; ?>
    </div>
</section>
            

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2024 Hotel Mérida INN. Todos los derechos reservados.</p>
    </footer>

    <script src="scripts/admin.js"></script>
</body>
</html>
