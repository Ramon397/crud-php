<?php

include('conexion.php');
include("funciones.php");

if(isset($_POST["id_usuario"]))//
{
	$imagen = obtener_nombre_imagen($_POST["id_usuario"]);//borra imagen de la carpeta
	if($imagen != '')//pregunta si la imagen no esta vacia
	{
		unlink("img/" . $imagen);//comando para eliminar imagen se pone la ruta y el nombre de la imagen
	}
	$stmt = $conexion->prepare(
		"DELETE FROM usuarios WHERE id = :id" //manda llamar la sentencia por el id optenido
	);
	$resultado = $stmt->execute(
		array(
			':id'	=>	$_POST["id_usuario"]
		)
	);
	
	if(!empty($resultado))//pregunta si el resultado no es vacio
	{
		echo 'Registro borrado';
	}
}



?>