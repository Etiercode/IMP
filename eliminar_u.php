<?php

include "php/conexion_back.php";

session_start();

if (empty($_GET['id_usuario'])) {
    header('location: usuarios.php');
}

$id = $_GET['id_usuario'];

$sql="DELETE FROM login WHERE id_usuario='$id'";
$query=mysqli_query($conexion,$sql);

if($query){
    header("Location: Usuarios.php");
}

?>