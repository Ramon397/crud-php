<?php
include("conexion.php");
include("funciones.php");
//funcion de crear
if ($_POST["operacion"] == "Crear") {
    $imagen = '';
    if ($_FILES["imagen_usuario"]["name"] != '') {
        $imagen = subir_imagen();
    }
    $stmt = $conexion->prepare("INSERT INTO usuarios(nombre, apellidos, imagen, telefono, email)VALUES(:nombre, :apellidos, :imagen, :telefono, :email)");

    $resultado = $stmt->execute(
        array(
            ':nombre'    => $_POST["nombre"],
            ':apellidos'    => $_POST["apellidos"],
            ':telefono'    => $_POST["telefono"],
            ':email'    => $_POST["email"],
            ':imagen'    => $imagen
        )
    );

    if (!empty($resultado)) {
        echo 'Registro creado';
    }
}
//funcion de modificar
if ($_POST["operacion"] == "Editar") {
    $imagen = '';//valida  la imagen en vacio
    if ($_FILES["imagen_usuario"]["name"] != '') {//vaida si el nombre esta vacio
        $imagen = subir_imagen();//utiliza la funcion para subir la imagen
    }else{
        $imagen=$_POST["imagen_usuario_oculta"];
    }
    //preparar consulta
    $stmt = $conexion->prepare("UPDATE usuarios SET nombre=:nombre,apellidos=:apellidos,imagen=:imagen,telefono=:telefono,email=:email WHERE id=:id");

    $resultado = $stmt->execute(
        array(
            ':nombre'    => $_POST["nombre"],
            ':apellidos'    => $_POST["apellidos"],
            ':telefono'    => $_POST["telefono"],
            ':email'    => $_POST["email"],
            ':imagen'    => $imagen, 
            'id'       =>$_POST["id_usuario"]
        )
    );

    if (!empty($resultado)) {
        echo 'Registro actualizado';
    }
}

?>