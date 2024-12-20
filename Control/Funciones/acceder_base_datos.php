<?php
include "Control/config/config.inc.php";

function abrirConexion() {
  // Declarar las variables globales dentro de la función
  global $servidor, $usuario, $contrasena, $base_datos;

  // Conectar con las credenciales de MySQL
  $pconector = mysqli_connect($servidor, $usuario, $contrasena)
      or die("Error al conectar a la base de datos: " . mysqli_connect_error());

  // Seleccionar la base de datos
  mysqli_select_db($pconector, $base_datos) 
      or die("Error al seleccionar la base de datos: " . mysqli_error($pconector));

  return $pconector;
}


//--------------------------------------------------------------------------------------------------------
function seleccionarBaseDatos($pconector){
 //Permite seleccionar una base de datos
 mysqli_select_db($pconector, $GLOBALS["base_datos"]) or die(mysqli_connect_error($pconector));
}
//--------------------------------------------------------------------------------------------------------
function cerrarConexion($pconector){
 //Cierra una conexión con la base de datos
 mysqli_close($pconector);
}
//--------------------------------------------------------------------------------------------------------|
function existeRegistro($pconector, $cquery){

 //Verifica la existencia de la información solicitada (a través de una sentencia SQL) en la base de datos
 $lexiste_referencia = true;
 $lresult = mysqli_query($pconector, $cquery);
 
 if (!$lresult){
   $cerror = "No fue posible recuperar la informaci&oacute;n de la base de datos.<br>";
   $cerror .= "SQL: $cquery <br>";
   $cerror .= "Descripci&oacute;n: ".mysqli_connect_error($pconector);
   die($cerror);   
 }
 else{
   //Verifica que no exista un registro igual al que se va a insertar
   if ( mysqli_num_rows($lresult) == 0 ){
     $lexiste_referencia = false;
   }
 }
 
   //Libera la memoria asociada al resultado de la consulta
 mysqli_free_result($lresult);
    
 return $lexiste_referencia;
 
}
//--------------------------------------------------------------------------------------------------------
function insertarDatos($pconector, $cquery){

 //Inserta un registro en la base de datos
 $lentrada_creada = false;
 $lresult = mysqli_query($pconector, $cquery);
 if (!$lresult){   
   $cerror = "Ocurri&oacute; un error al acceder a la base de datos.<br>";
   $cerror .= "SQL: $cquery <br>";
   $cerror .= "Descripci&oacute;n: ".mysqli_connect_error($pconector);
   die($cerror);
 }
 else{
   if (mysqli_affected_rows($pconector) > 0){
     $lentrada_creada = true;
   }
 }
      
 return $lentrada_creada;
}
//--------------------------------------------------------------------------------------------------------
function extraerRegistro($pconector, $cquery){

   /*Lee información solicitada (a través de una sentencia SQL) de la base de datos y la almacena
     en un arreglo que devuelve como parámetro de salida.
     Advertencia: utilizar esta función únicamente cuando se espere un sólo registro como resultado*/

$aregistro = array();
$lresult = mysqli_query($pconector, $cquery);
 if (!$lresult){
   $cerror = "No fue posible recuperar la informaci&oacute;n de la base de datos.<br>";
   $cerror .= "SQL: $cquery <br>";
   $cerror .= "Descripci&oacute;n: ".mysqli_connect_error($pconector);
   die($cerror);   
 }
 else{
   if (mysqli_num_rows($lresult) > 0){  	      
   	 $aregistro = mysqli_fetch_array($lresult);
   }
 }
   
   //Libera la memoria asociada al resultado de la consulta
 mysqli_free_result($lresult);
 reset($aregistro);
 
 return $aregistro;
}
//--------------------------------------------------------------------------------------------------------
function editarDatos($pconector, $cquery){

 //Modifica, edita o actualiza uno o más registros de la base de datos
 $ledicion_completada = false;
 $lresult = mysqli_query($pconector, $cquery);
 if (!$lresult){
   $cerror = "Ocurri&oacute; un error al acceder a la base de datos.<br>";
   $cerror .= "SQL: $cquery <br>";
   $cerror .= "Descripci&oacute;n: ".mysqli_connect_error($pconector);
   die($cerror);
 }
 else{
   $ledicion_completada = true;
 }
      
 return $ledicion_completada;
}
//--------------------------------------------------------------------------------------------------------
function borrarDatos($pconector, $cquery){

 //Elimina uno o más registros de la base de datos
 $laccion_completada = false;
 $lresult = mysqli_query($pconector, $cquery);
 if (!$lresult){
   $cerror = "Ocurri&oacute; un error al acceder a la base de datos.<br>";
   $cerror .= "SQL: $cquery <br>";
   $cerror .= "Descripci&oacute;n: ".mysqli_connect_error($pconector);
   die($cerror);
 }
 else{
   $laccion_completada = true;
 }
      
 return $laccion_completada;
}
function obtenerHabitacionesAgrupadas() {
  $pconexion = abrirConexion();
  seleccionarBaseDatos($pconexion);

  $cquery = "SELECT tipo, GROUP_CONCAT(id_habitacion) AS habitaciones 
             FROM habitaciones 
             GROUP BY tipo";
  $resultado = $pconexion->query($cquery);

  $habitacionesAgrupadas = [];
  if ($resultado) {
      while ($fila = $resultado->fetch_assoc()) {
          $habitacionesAgrupadas[] = $fila;
      }
  }

  cerrarConexion($pconexion);
  return $habitacionesAgrupadas;
}

?>