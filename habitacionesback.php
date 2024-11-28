<?php
include "Control/Funciones/acceder_base_datos.php";
include "Control/config/config.inc.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'alta_habitacion':
                if (isset($_POST["btn_grabar"]) && $_POST["btn_grabar"] === "Grabar") {
                    echo agregarHabitacion(); // Llama a la función para agregar la habitación
                }
                break;

            case 'editar_habitacion':
                if (isset($_POST["btn_actualizar"]) && $_POST["btn_actualizar"] === "Actualizar") {
                    $id_habitacion = $_POST["cuarto-id"];
                    echo actualizarHabitacion($id_habitacion); // Llama a la función para actualizar la habitación
                }
                break;

            case 'eliminar_habitacion':
                if (isset($_POST["cuarto-id-eliminar"])) {
                    $id_habitacion = $_POST["cuarto-id-eliminar"];
                    echo eliminarHabitacion($id_habitacion); // Llama a la función para eliminar la habitación
                }
                break;

                case 'buscar_habitacion':
                    // Recibir valores del formulario
                    $criterio = $_POST['criterio-busqueda'];
                    $valor = $_POST['valor-busqueda'];
                
                    // Validar entradas
                    if (empty($criterio) || empty($valor)) {
                        echo "Por favor completa todos los campos para buscar.";
                        exit;
                    }
                
                    // Conectar a la base de datos
                    $pconexion = abrirConexion();
                    seleccionarBaseDatos($pconexion);
                
                    // Preparar consulta
                    $cquery = "SELECT * FROM habitaciones WHERE $criterio LIKE '%$valor%'";
                    $resultado = $pconexion->query($cquery);
                
                    // Verificar resultado
                    if ($resultado->num_rows > 0) {
                        echo "<h3>Resultados de la búsqueda:</h3>";
                        echo "<ul>";
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<li>Habitación ID: {$fila['id_habitacion']} - Tipo: {$fila['tipo']} - Precio: {$fila['precio']} - Capacidad: {$fila['capacidad']}</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "No se encontraron habitaciones para el criterio especificado.";
                    }
                
                    // Enlace de regreso al panel de administración
                    echo '<a href="admin.php">Regresar al panel de administración</a>';
                
                    cerrarConexion($pconexion);
                    exit;
                }                
    }
}

function agregarHabitacion(): string {
    $cmensaje = "";

    if (isset($_POST["btn_grabar"]) && $_POST["btn_grabar"] == "Grabar") {
        // Recibir los datos del formulario
        $tipo = $_POST["txt_tipo"];
        $precio = $_POST["txt_precio"];
        $capacidad = $_POST["txt_capacidad"];
        $disponible = isset($_POST["chk_disponible"]) ? 1 : 0;

        // Subida de imágenes
        $imagenes = [];
        if (isset($_FILES["imagenes_habitacion"])) {
            foreach ($_FILES["imagenes_habitacion"]["tmp_name"] as $key => $tmp_name) {
                $imagen_nombre = $_FILES["imagenes_habitacion"]["name"][$key];
                $imagen_tmp = $_FILES["imagenes_habitacion"]["tmp_name"][$key];
                $imagen_destino = "images/habitaciones/" . basename($imagen_nombre);
                
                // Intentar mover la imagen a la carpeta destino
                if (move_uploaded_file($imagen_tmp, $imagen_destino)) {
                    $imagenes[] = $imagen_destino; // Guardar la ruta de la imagen
                } else {
                    $cmensaje = "Error al subir la imagen: $imagen_nombre";
                    return $cmensaje;
                }
            }
        }

        // Convertir el array de imágenes en una cadena separada por comas
        $imagenes_str = implode(",", $imagenes);

        // Conectar a la base de datos
        $pconexion = abrirConexion();
        seleccionarBaseDatos($pconexion);

        // Preparar la consulta SQL para insertar los datos
        $cquery = "INSERT INTO habitaciones (tipo, precio, capacidad, disponible, Imagenes) 
                   VALUES ('$tipo', $precio, $capacidad, $disponible, '$imagenes_str')";

        // Ejecutar la consulta
        if (insertarDatos($pconexion, $cquery)) {
            $cmensaje = "Habitación registrada exitosamente";
        } else {
            $cmensaje = "No fue posible registrar la habitación";
        }

        // Cerrar la conexión
        cerrarConexion($pconexion);
    }

    return $cmensaje;
}


function obtenerHabitacion($id_habitacion) {
    $pconexion = abrirConexion();
    seleccionarBaseDatos($pconexion);
    
    $cquery = "SELECT * FROM habitaciones WHERE id_habitacion = '$id_habitacion'";
    $resultado = existeRegistro($pconexion, $cquery);
    
    cerrarConexion($pconexion);
    return $resultado->fetch_assoc(); // Retorna los datos de la habitación
}

function actualizarHabitacion($id_habitacion) {
    $cmensaje = "";
    if (isset($_POST["btn_actualizar"]) && $_POST["btn_actualizar"] == "Actualizar") {
        $tipo = $_POST["txt_tipo"];
        $precio = $_POST["txt_precio"];
        $capacidad = $_POST["txt_capacidad"];
        $disponible = isset($_POST["chk_disponible"]) ? 1 : 0;

        $imagenes = [];
        if (isset($_FILES["imagenes_habitacion"])) {
            foreach ($_FILES["imagenes_habitacion"]["tmp_name"] as $key => $tmp_name) {
                $imagen_nombre = $_FILES["imagenes_habitacion"]["name"][$key];
                $imagen_tmp = $_FILES["imagenes_habitacion"]["tmp_name"][$key];
                $imagen_destino = "images/habitaciones/" . basename($imagen_nombre);
                
                // Intentar mover la imagen a la carpeta destino
                if (move_uploaded_file($imagen_tmp, $imagen_destino)) {
                    $imagenes[] = $imagen_destino; // Guardar la ruta de la imagen
                } else {
                    $cmensaje = "Error al subir la imagen: $imagen_nombre";
                    return $cmensaje;
                }
            }
        }

        // Convertir el array de imágenes en una cadena separada por comas
        $imagenes_str = implode(",", $imagenes);

        
        $pconexion = abrirConexion();
        seleccionarBaseDatos($pconexion);

        // Actualizar habitación
        $cquery = "UPDATE habitaciones SET tipo = '$tipo', precio = $precio, capacidad = $capacidad, disponible = $disponible, imagenes = '$imagenes_str'
                   WHERE id_habitacion = '$id_habitacion'";
        if (insertarDatos($pconexion, $cquery)) {
            $cmensaje = "Habitación actualizada exitosamente";
        } else {
            $cmensaje = "No fue posible actualizar la habitación";
        }

        cerrarConexion($pconexion);
    }

    return $cmensaje;
}

function eliminarHabitacion($id_habitacion) {
    $cmensaje = "";

    $pconexion = abrirConexion();
    seleccionarBaseDatos($pconexion);

    // Eliminar la habitación
    $cquery = "DELETE FROM habitaciones WHERE id_habitacion = '$id_habitacion'";
    if (insertarDatos($pconexion, $cquery)) {
        $cmensaje = "Habitación eliminada exitosamente";
    } else {
        $cmensaje = "No fue posible eliminar la habitación";
    }

    cerrarConexion($pconexion);

    return $cmensaje;
}


?>