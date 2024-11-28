<?php
session_start();
include "Control/Funciones/acceder_base_datos.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'agregar') {
        $id_usuario = $_SESSION['usuario_id'] ?? null; // Usuario debe estar autenticado
        $id_habitacion = $_POST['id_habitacion'];
        $cantidad = 1; // Siempre añade una habitación por defecto

        if ($id_usuario) {
            $conexion = abrirConexion();

            // Verificar disponibilidad
            $queryDisponibilidad = "SELECT disponibles FROM habitaciones WHERE id_habitacion = $id_habitacion";
            $resultado = $conexion->query($queryDisponibilidad);
            $habitacion = $resultado->fetch_assoc();

            if ($habitacion['disponibles'] > 0) {
                // Añadir al carrito
                $queryCarrito = "INSERT INTO carrito (id_usuario, id_habitacion, cantidad) 
                                 VALUES ($id_usuario, $id_habitacion, $cantidad)";
                $conexion->query($queryCarrito);

                // Reducir disponibilidad
                $queryActualizar = "UPDATE habitaciones SET disponibles = disponibles - 1 
                                    WHERE id_habitacion = $id_habitacion";
                $conexion->query($queryActualizar);

                echo "Habitación añadida al carrito.";
            } else {
                echo "No hay habitaciones disponibles.";
            }

            cerrarConexion($conexion);
        } else {
            echo "Debes iniciar sesión para reservar.";
        }
    }
}
?>
