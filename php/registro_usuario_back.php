<?php

include 'conexion_back.php';

$usuario = $_POST['usuario'];
$nombreusuario = $_POST['nombreusuario'];
$clave = $_POST['clave'];
$rol = $_POST['rol'];
$sexo = $_POST['sexo'];
$correo = $_POST['correo'];
$numero_telef = $_POST['numero_telef'];
$direccion = $_POST['direccion'];

if (empty($usuario)) {
    echo '<script>alert("Campo usuario Vacío");
        window.location = "../agregar_usuario.php";</script>';
    mysqli_close($conexion);
}
if (is_numeric($usuario)) {
    echo '<script>alert("Campo usuario debe ser solo texto");
            window.location = "../agregar_usuario.php";</script>';
    mysqli_close($conexion);
}
if (empty($nombreusuario)) {
    echo '<script>alert("Campo Nombre de Usuario Vacío");
        window.location = "../agregar_usuario.php";</script>';
}
if (is_numeric($nombreusuario)) {
    echo '<script>alert("Campo Nombre de Usuario debe ser solo texto");
            window.location = "../agregar_usuario.php";</script>';
    mysqli_close($conexion);
}
if (empty($clave)) {
    echo '<script>alert("Campo Clave Vacío");
        window.location = "../agregar_usuario.php";</script>';
    mysqli_close($conexion);
}
if (empty($correo)) {
    echo '<script>alert("Campo Correo Vacío");
        window.location = "../agregar_usuario.php";</script>';
    mysqli_close($conexion);
}
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("Campo Correo es Incorrecto");
            window.location = "../agregar_usuario.php";</script>';
    mysqli_close($conexion);
}

$query = "INSERT INTO login(usuario, nombreusuario, clave, rol, correo, sexo, direccion, numero_telef) 
    VALUES('$usuario', '$nombreusuario', '$clave', '$rol', '$correo', '$sexo', '$direccion', '$numero_telef')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '

<script>
alert("Usuario Agregado");
window.location = "../agregar_usuario.php";
</script>

';
} else {

    echo '

<script>
alert("Usuario no Almacenado");
window.location = "../agregar_usuario.php";
</script>

';
}

mysqli_close($conexion);
