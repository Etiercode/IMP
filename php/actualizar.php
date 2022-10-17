<?php
include "conexion_back.php";

$id_usuario = $_POST['id_usuario'];
$usuario = $_POST['usuario'];
$nombreusuario = $_POST['nombreusuario'];
$clave = $_POST['clave'];
$rol = $_POST['rol'];
$sexo = $_POST['sexo'];
$correo = $_POST['correo'];
$numero_telef = $_POST['numero_telef'];

$sql = "UPDATE login SET usuario='$usuario',nombreusuario='$nombreusuario',clave='$clave',rol='$rol',sexo='$sexo',correo='$correo',numero_telef='$numero_telef";
$query = mysqli_query($conexion, $sql);
if ($query) {
    header("Location: ../usuarios.php");
}
