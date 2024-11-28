<?php
session_start();
include "Control/Funciones/acceder_base_datos.php"; // Archivo que conecta a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Conectar a la base de datos
    $conexion = abrirConexion();
    $query = "SELECT id_usuarios, nombre_usuario, rol FROM usuarios WHERE email_usuario = '$email' AND contrasena = '$password' AND activo = 1";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Configurar variables de sesión
        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['usuario_nombre'] = $usuario['nombre_usuario'];
        $_SESSION['usuario_rol'] = $usuario['rol']; // Guardar el rol del usuario

        // Redirigir según el rol
        if ($_SESSION['usuario_rol'] === 'Admin') {
            header("Location: admin.php"); // Página para el administrador
        } elseif ($_SESSION['usuario_rol'] === 'Huesped') {
            header("Location: index.php"); // Página para el huesped
        } else {
            echo "Rol no reconocido.";
        }
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }

    cerrarConexion($conexion);
}
?>
